<?php

namespace Modules\User\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\User\Emails\UserBlockedMail;
use Modules\User\Entities\User;
use Modules\User\Events\UserBlocked;
use Modules\User\Events\UserCancelBlocked;
use Modules\User\Http\Requests\UserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $filters = request()->query();
        $count = (int) request()->query('count');
        $users = User::filters($filters)->latest()->paginate($count == 0 ? 7 : $count);
        return view('user::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }


    public function ban(User $user)
    {
        return view('user::ban', compact('user'));
    }


    public function blocked(Request $request, User $user)
    {
        $data = $request->validate([
            'ban_reason' => 'required|string|max:255',
            'ban_at' => 'required|date'

        ], attributes: [
            'ban_reason' => 'سبب الحظر',
            'ban_at' => 'مدة الحظر'
        ]);
        $user->update($data);
        UserBlocked::dispatch($user);
        return to_route('dashboard.users.index')->with(['notification' => " تم حظر   $user->name بنجاح"]);
    }

    public function cancelBan(User $user)
    {
        $user->update([
            'ban_reason' => null,
            'ban_at' => null
        ]);
        UserCancelBlocked::dispatch($user);
        return to_route('dashboard.users.index')->with(['notification' => " تم إلغاء حظر   $user->name بنجاح"]);

    }



    public function store(UserRequest $request): RedirectResponse
    {
        \DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $user->uploadOnDisk($file, str_replace(' ', '_', $user->name));
                $user->storeImage($path, \Str::slug($file->getClientOriginalName()));
            }

        });
        return back()->with(['notification' => 'تمت اضافة مستخدم جديد بنجاح']);
    }


    public function show(User $user)
    {
        return view('user::show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('user::edit', compact('user'));
    }


    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated('password');
        if (empty($data['password'])) {
            $data = $request->except('password');
        }
        \DB::transaction(function () use ($request, $user, $data) {
            $user->update($data);
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $user->uploadOnDisk($file, str_replace(' ', '_', $user->name));
                $user->updateImage($path, \Str::slug($file->getClientOriginalName()));
            }
        });
        return to_route('dashboard.users.index')->with(['notification' => " تم تعديل بيانات $user->name بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $user)
    {
        $isDeleted = $user->delete();
        if ($isDeleted) {
            $user->deleteImage();
        }
        return \Modules\Shared\Helpers\DeleteAjaxRespose::deleteAjaxResponse($isDeleted);
    }
}
