<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::latest()->paginate(5);
        return view('roles.index', compact('roles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::create($request->all());
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }


    public function show(Role $role)
    {
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $role->id)
            ->get();
        return view('roles.show', compact('role','rolePermissions'));
    }

    public function edit(Role $role)
    {
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role','permission','rolePermissions'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->all());
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')

            ->with('success', 'Role updated successfully');
    }


    public function destroy(Role $role)

    {
        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
