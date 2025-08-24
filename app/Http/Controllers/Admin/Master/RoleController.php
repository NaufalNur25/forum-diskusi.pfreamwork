<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Master\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Master\Role\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::query()->paginate(5);

        return view('Admin.Master.Role.index', compact('roles'));
    }

    public function create()
    {
        return view('Admin.Master.Role.create');
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create($request->all());

        return redirect()
            ->route('admin.master.role')
            ->with('success', 'Successfully create new role');
    }

    public function edit(Role $role)
    {
        return view('Admin.Master.Role.edit', compact('role'));
    }


    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());

        return redirect()
            ->route('admin.master.role')
            ->with('success', 'Successfully updated role');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('admin.master.role')
            ->with('success', 'Successfully deleted role');
    }
}
