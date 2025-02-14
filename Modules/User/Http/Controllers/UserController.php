<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        return view('user::index', [
            'users' => User::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }


    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->validated());
        return back()->with(['notification' => 'تمت اضافة مستخدم جديد بنجاح']);
    }


    public function show(User $user)
    {
        return view('user::show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('user::edit',compact('user'));
    }


    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());
        return to_route('dashboard.users.index')->with(['notification' => " تم تعديل بيانات $user->name بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
