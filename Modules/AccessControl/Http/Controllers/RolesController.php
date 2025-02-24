<?php

namespace Modules\AccessControl\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AccessControl\Http\Requests\RolesRequest;
use Modules\Shared\Helpers\DeleteAjaxRespose;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = Role::where('name','<>','super_admin')->get();
        return view('accesscontrol::index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('accesscontrol::create', compact('permissions'));
    }


    public function store(RolesRequest $request): RedirectResponse
    {

        \DB::transaction(function () use ($request) {
            $role = Role::create(['name' => $request->name, 'module_name' => 'admin', 'guard_name' => 'admin']);
            $role->syncPermissions(array_map(function ($value) {
                return (int) $value;
            }, $request->permission_ids));
        });
        return back()->with(['notification' => "تم اضافة $request->name بنجاح"]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Role $role)
    {
        return view('accesscontrol::show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)->pluck('id', 'id')->toArray();
        return view('accesscontrol::edit', compact('role', 'rolePermissions', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(RolesRequest $request, Role $role): RedirectResponse
    {

        \DB::transaction(function () use ($request, $role) {
            $role->update(['name' => $request->name]);
            $role->syncPermissions(array_map(function ($value) {
                return (int) $value;
            }, $request->permission_ids));
        });
        return to_route('dashboard.roles.index')->with(['notification' => "تم تعديل بيانات $request->name بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Role $role)
    {
        $isDeleted = $role->delete();
        return DeleteAjaxRespose::deleteAjaxResponse($isDeleted);
    }
}
