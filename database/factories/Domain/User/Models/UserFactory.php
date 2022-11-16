<?php

namespace Database\Factories\Domain\User\Models;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'nickName' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'is_email_verified' => true,
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
