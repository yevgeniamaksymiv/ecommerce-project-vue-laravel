<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $request->validated();

        $role = Role::create(['name' => $request->get('name')]);
        $permissions = collect($request->input('permissions', []))
            ->map(function ($permission) {
                return ['permission_id' => $permission];
            });
        $role->permissions()->sync($permissions);
        session(['message' => 'Role created successfully']);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $checkedPermissions = DB::table('permission_role')
            ->where('role_id', $role->id)
            ->pluck('permission_id')->toArray();

        return view('roles.edit', compact(['role', 'permissions', 'checkedPermissions']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();

        $permissions = collect($request->input('permissions', []))
            ->map(function ($permission) {
                return ['permission_id' => $permission];
            });
        $role->permissions()->sync($permissions);

        $role->update($data);
        session(['message' => 'Role updated successfully']);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->permissions()->detach();
        $role->delete();
        session(['message' => 'Role deleted successfully']);
        return redirect()->route('roles.index');
    }
}
