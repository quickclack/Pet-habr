<?php

namespace Tests\Feature\App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\RegisteredController;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RegisteredPageTest extends TestCase
{
    use RefreshDatabase;

    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = [
            'id' => 10,
            'nickName' => 'Test',
            'email' => 'test@mail.com',
            'password' => '12345qwertyWWW',
            'password_confirmation' => '12345qwertyWWW',
        ];
    }

    private function request(array $headers = []): TestResponse
    {
        return $this->post(action([RegisteredController::class, 'store'],
            $this->request), $headers);
    }

    private function findUser(): User
    {
        return User::query()
            ->where('email', $this->request['email'])
            ->first();
    }

    public function test_registered_page_status(): void
    {
        $this->get('/signup')
            ->assertOk();
    }

    public function test_is_validation_success(): void
    {
        $this->request()
            ->assertValid();
    }

    public function test_it_should_validation_on_password_confirm(): void
    {
        $this->request['password'] = 123;
        $this->request['password_confirmation'] = 1234;

        $this->request()
            ->assertInvalid(['password']);
    }

    public function test_it_user_created_success(): void
    {
        $this->assertDatabaseMissing('users', [
            'email' => $this->request['email']
        ]);

        $this->request();

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);
    }

    public function test_it_should_fail_validation_on_unique_email(): void
    {
        UserFactory::new()->create([
            'email' => $this->request['email']
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $this->request['email']
        ]);

        $this->request()
            ->assertInvalid();
    }
}
