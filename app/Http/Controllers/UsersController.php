<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use App\Repositories\Contracts\RoleRepositoryInterface as RoleRepository;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\User;

class UsersController extends Controller
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all(['profile'])->filter(function ($user) {
            return $user->email != auth()->user()->email;
        });

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleRepository->all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $this->userRepository->store($request->all());

        return redirect()->route('users.list')->with('status', 'User successfully created.');
    }

    public function edit(User $user)
    {
        $roles = $this->roleRepository->all();
        $user_roles = $user->roles->pluck('id')->all();

        return view('users.edit', compact('user', 'user_roles', 'roles'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $this->authorize('update', $user);

        $this->userRepository->update($user->id, $request->all());

        return redirect()->route('users.list')->with('status', 'User successfully updated.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $this->userRepository->delete($user->id);

        return response()->json([
            'success' => true,
            'message' => 'User successfully deleted.'
        ]);
    }
}
