<?php

namespace App\Repositories;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function all($relationships = [])
    {
        return $this->permission->with($relationships)->get();
    }

    public function find($id, $relationships = [])
    {
        return $this->permission->with($relationships)->find($id);
    }

    public function store($data)
    {
        $permission = $this->permission;
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        $permission->save();
    }

    public function update($id, $data)
    {
        $permission = $this->permission->find($id);
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        $permission->save();
    }

    public function delete($id)
    {
        $permission = $this->find($id);
        $permission->delete();
    }
}