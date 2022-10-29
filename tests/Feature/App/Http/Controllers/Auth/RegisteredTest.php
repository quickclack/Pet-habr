<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisteredTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_user_in_database(): void
    {
        User::factory()->create([
            'id' => 1,
            'nickName' => 'Test',
            'email' => 'test@mail.com',
            'password' => '12345qwerty',
        ]);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'nickName' => 'Test'
        ]);
    }
}
