<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface
{
    public function all($relationships = []);

    public function published($relationships = []);

    public function find($id, $relationships = []);

    public function create($data);

    public function update($id, $data);
}