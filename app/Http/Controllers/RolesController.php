<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\RoleRepositoryInterface as RoleRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface as PermissionRepository;
use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Role;

class RolesController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $roles = $this->roleRepository->all(['permissions'])->filter(function ($role) {
            return $role->name != 'superadmin';
        });

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = $this->permissionRepository->all();

        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);

        $this->roleRepository->store($request->all());

        return redirect()->route('roles.list');
    }

    public function edit(Role $role)
    {
        $permissions = $this->permissionRepository->all();
        $role_permissions = $role->permissions->pluck('id')->all();

        return view('roles.edit', compact('role', 'role_permissions', 'permissions'));
    }

    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->authorize('update', $role);

        $this->roleRepository->update($role->id, $request->all());

        return redirect()->route('roles.list');
    }
}
