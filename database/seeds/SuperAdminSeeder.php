<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Profile;
use App\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User
        $user = User::create([
            'email' => 'superadmin@learninglaravel.com',
            'password' => Hash::make('123456')
        ]);

        // Profile
        $profile = new Profile([
            'first_name' => 'peter',
            'last_name' => 'wall'
        ]);

        // Save profile
        $user->profile()->save($profile);

        // Role
        $role = Role::create([
            'name' => 'superadmin',
            'description' => 'Super admin role.'
        ]);

        // Attach roles
        $user->roles()->attach($role);
    }
}
