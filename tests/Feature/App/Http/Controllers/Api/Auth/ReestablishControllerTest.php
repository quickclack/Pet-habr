<?php

namespace Tests\Feature\App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\ReestablishController;
use App\Jobs\SendNewPasswordJob;
use Database\Factories\Domain\User\Models\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ReestablishControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_user_reestablish_success(): void
    {
        $queue = Queue::getFacadeRoot();

        Queue::fake([SendNewPasswordJob::class]);

        $password = Str::random(15);

        $user = UserFactory::new()
            ->createOne();

        $this->post(action(ReestablishController::class), ['email' => $user->email])
            ->assertOk()
            ->assertJson(['message' => 'Временный пароль был отправлен на вашу почту']);

        Queue::swap($queue);

        SendNewPasswordJob::dispatchSync($user, $password);
    }

    public function test_it_cannot_reestablish(): void
    {
        $this->expectException(ValidationException::class);

        $this->post(action(ReestablishController::class), ['email' => ''])
            ->assertStatus(302)
            ->assertJson(['message' => 'Поле email обязательно для заполнения.']);
    }

    public function test_if_not_true_email(): void
    {
        $this->expectException(ValidationException::class);

        $this->post(action(ReestablishController::class), ['email' => 'some.email@mail.com'])
            ->assertStatus(302)
            ->assertJson(['message' => 'Выбранное значение для email некорректно.']);
    }
}
