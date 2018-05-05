<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Profile;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all($relationships = [])
    {
        return $this->user->with($relationships)->get();
    }

    public function find($id, $relationships = [])
    {
        return $this->user->with($relationships)->find($id);
    }

    public function store($data)
    {
        $user = $this->user;
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        $profile = new Profile([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'address' => $data['address']
        ]);
        $user->profile()->save($profile);

        if (array_key_exists('roles', $data)) {
            $user->roles()->attach($data['roles']);
        }
    }

    public function update($id, $data)
    {
        $user = $this->find($id);
        $user->profile->first_name = $data['first_name'];
        $user->profile->last_name = $data['last_name'];
        $user->profile->mobile = $data['mobile'];
        $user->profile->address = $data['address'];
        $user->profile->save();

        if (array_key_exists('roles', $data)) {
            $user->roles()->sync($data['roles']);
        }
    }
}