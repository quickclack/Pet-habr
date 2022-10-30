<?php

namespace Database\Seeders;

use Domain\User\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Moderator']);
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Guest']);
    }
}
