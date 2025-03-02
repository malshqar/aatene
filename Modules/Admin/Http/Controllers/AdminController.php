<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Http\Requests\AdminRequest;
use Modules\Shared\Helpers\Slug;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.index')->only('index');
        $this->middleware('can:admin.create')->only('create');
        $this->middleware('can:admin.edit')->only('edit');
        $this->middleware('can:admin.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $filters = request()->query();
        $count = (int) request()->query('count');
        $admins = Admin::skipAuth()->skipOwner()->filters($filters)->latest()->paginate(($count == 0 && $count >= 100) ? 7 : $count);
        return view('admin::index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin::create', compact('roles'));
    }

    public function store(AdminRequest $request): RedirectResponse
    {
        \DB::transaction(function () use ($request) {
            $data = $request->validated();
            foreach ($request->role_ids as $id) {
                $names[] = Role::findById($id)->name;
                $data['role_name'] = $names;
            }
            $admin = Admin::create($data);
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $admin->uploadOnDisk($file, str_replace(' ', '_', $admin->name));
                $admin->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            foreach ($names as $role) {
                $admin->assignRole($role);
            }
        });
        return back()->with(['notification' => 'تمت اضافة مدير جديد بنجاح']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Admin $admin)
    {
        return view('admin::show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Admin $admin)
    {
        $roles = Role::get();
        return view('admin::edit', compact('admin', 'roles'));
    }


    public function update(AdminRequest $request, Admin $admin): RedirectResponse
    {
        $data = $request->validated('password');
        if (empty($data['password'])) {
            $data = $request->except('password');
        }
        foreach ($request->role_ids ?? [] as $id) {
            $names[] = Role::findById($id)->name;
            $data['role_name'] = $names;
        }
        \DB::transaction(function () use ($request, $admin, $data, $names) {
            $admin->update($data);
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $admin->uploadOnDisk($file, str_replace(' ', '_', $admin->name));
                $admin->updateImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));
            }
            foreach ($names as $role) {
                $admin->assignRole($role);
            }
        });
        return to_route('dashboard.admins.index')->with(['notification' => " تم تعديل بيانات $admin->name بنجاح"]);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Admin $admin)
    {
        $isDeleted = $admin->delete();
        if ($isDeleted) {
            $admin->deleteImage();
        }
        return \Modules\Shared\Helpers\DeleteAjaxRespose::deleteAjaxResponse($isDeleted);
    }
}
