<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Api\Auth\RegisteredController;
use Domain\User\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
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

    public function test_can_user_registered(): void
    {
        Event::fake();
        Notification::fake();

        $request = [
            'nickName' => 'Test2',
            'email' => 'test11@mail.com',
            'password' => '12345qwertyW',
            'password_confirmation' => '12345qwertyW'
        ];

        $response = $this->post(
            action([RegisteredController::class, 'store']),
            $request);

        $response->assertValid();

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', [
            'email' => $request['email'],
        ]);

        /* @var Authenticatable $user */
        $user = User::query()->where('email', $request['email'])->first();

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailVerificationNotification::class);

        $event = new Registered($user);
        $listener = new SendEmailVerificationNotification();
        $listener->handle($event);

        $this->assertAuthenticatedAs($user);
    }

    public function test_failed_registered(): void
    {
        $request = [
            'nickName' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => ''
        ];

        $response = $this->post(
            action([RegisteredController::class, 'store']),
            $request);

        $response->assertInvalid();
    }
}
