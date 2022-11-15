<?php

namespace Tests\Unit\App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\SocialiteController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Testing\TestResponse;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Mockery\MockInterface;
use Tests\TestCase;

class SocialiteControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private function mockSocialiteCallback(string $githubEmail): MockInterface
    {
        $user = $this->mock(SocialiteUser::class, function (MockInterface $mock) use ($githubEmail) {
            $mock->shouldReceive('getNickname')
                ->once()
                ->andReturn('Test');

            $mock->shouldReceive('getEmail')
                ->once()
                ->andReturn('testing@mail.com');

            $mock->shouldReceive('getName')
                ->once()
                ->andReturn('TestTest');
        });

        Socialite::shouldReceive('driver->user')
            ->once()
            ->andReturn($user);

        return $user;
    }

    private function callBackRequest(): TestResponse
    {
        return $this->get('api/auth/github/callback');
    }

    public function test_it_github_callback_created_user_success(): void
    {
        $this->markTestIncomplete('Вернемся к нему позже');
    }
}
