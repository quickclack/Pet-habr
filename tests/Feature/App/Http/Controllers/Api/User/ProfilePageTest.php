<?php

namespace Tests\Feature\App\Http\Controllers\Api\User;

use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_user_update_profile(): void
    {
        UserFactory::new()->create([
            'nickName' => 'Test',
            'email' => 'testt@mail.com',
            'password' => '123456'
        ]);

        $this->assertDatabaseHas('users', [
            'nickName' => 'Test',
            'email' => 'testt@mail.com'
        ]);

        $user = User::query()
            ->where('email', 'testt@mail.com')
            ->first();

        $user->update([
            'nickName' => 'Success',
            'firstName' => 'Test',
            'lastName' => 'Testov',
        ]);

        $this->assertDatabaseHas('users', [
            'nickName' => 'Success',
            'firstName' => 'Test'
        ]);
    }
}
