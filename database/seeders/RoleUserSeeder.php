<?php

namespace Database\Seeders;

use Domain\User\Models\Role;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::all();

        User::all()->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(rand(2, 4))->pluck('id')->toArray()
            );
        });
    }
}
