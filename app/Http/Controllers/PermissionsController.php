<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PermissionRepositoryInterface as PermissionRepository;
use App\Http\Requests\Permissions\StorePermissionRequest;
use App\Http\Requests\Permissions\UpdatePermissionRequest;
use App\Permission;

class PermissionsController extends Controller
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->all(['roles']);

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        $this->authorize('create', Permission::class);

        $this->permissionRepository->store($request->all());

        return redirect()->route('permissions.list');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Permission $permission, UpdatePermissionRequest $request)
    {
        $this->authorize('update', $permission);

        $this->permissionRepository->update($permission->id, $request->all());

        return redirect()->route('permissions.list');
    }
}
