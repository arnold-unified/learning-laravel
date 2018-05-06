<?php

namespace App\Repositories\Contracts;

interface RoleRepositoryInterface
{
    public function all($relationships = []);

    public function find($id, $relationships = []);

    public function store($data);

    public function update($id, $data);

    public function delete($id);
}