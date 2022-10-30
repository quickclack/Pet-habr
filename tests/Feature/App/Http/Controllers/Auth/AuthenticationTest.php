<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthenticatedController;
use Database\Factories\Domain\User\Models\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_user_auth(): void
    {
        UserFactory::new()->create([
            'id' => 1,
            'nickName' => 'Test1',
            'email' => 'test1@mail.com',
            'password' => 12345
        ]);

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'nickName' => 'Test1',
        ]);

        $response = $this->post(action([AuthenticatedController::class, 'store']), [
            'email' => 'test1@mail.com',
            'password' => 12345
        ]);

        $response->assertRedirect('/');
    }

    public function test_can_user_logout(): void
    {
        $user = UserFactory::new()->create([
            'id' => 2,
            'nickName' => 'Test2',
            'email' => 'test12@mail.com',
            'password' => 12345
        ]);

        $this->actingAs($user)
            ->get(action([AuthenticatedController::class, 'logout']));

        $this->assertGuest();
    }
}
