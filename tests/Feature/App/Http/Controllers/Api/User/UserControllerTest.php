<?php

namespace Tests\Feature\App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\User\UserController;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    private function getUser(): User
    {
        $user = UserFactory::new()
            ->createOne();

        Sanctum::actingAs($user);

        return $user;
    }

    private function getToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    private function authorize(User $user): array
    {
        return [
            'Authenticated' => 'Bearer' . $this->getToken($user)
        ];
    }

    public function test_get_user_success(): void
    {
        $user = $this->getUser();

        $this->post(action([UserController::class, 'getUser']), $this->authorize($user))
            ->assertOk();

        $this->assertEquals($user->getKey(), $user->getKey(), true);
    }
}
