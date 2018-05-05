<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Role;

class RoleRepository implements RoleRepositoryInterface
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function all($relationships = [])
    {
        return $this->role->with($relationships)->get();
    }

    public function find($id, $relationships = [])
    {
        return $this->role->with($relationships)->find($id);
    }

    public function store($data)
    {
        $role = $this->role;
        $role->name = $data['name'];
        $role->description = $data['description'];
        $role->save();

        if (array_key_exists('permissions', $data)) {
            $role->permissions()->attach($data['permissions']);
        }
    }

    public function update($id, $data)
    {
        $role = $this->find($id);
        $role->name = $data['name'];
        $role->description = $data['description'];
        $role->save();

        if (array_key_exists('permissions', $data)) {
            $role->permissions()->sync($data['permissions']);
        }
    }
}