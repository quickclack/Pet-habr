<?php

namespace Tests\Feature\Domain\User\Actions;

use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Actions\Contracts\UpdateProfileContract;
use Domain\User\DTO\UpdateProfileDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UpdateProfileActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_success_profile_updated(): void
    {
        Storage::fake('public');

        $actions = app(UpdateProfileContract::class);

        $user = UserFactory::new()->createOne();

        $actions(UpdateProfileDto::make('test',
            'testov',
            'tester',
            'male',
            UploadedFile::fake()->image('image.jpg', 1, 1)), $user->getKey());

        $this->assertDatabaseHas('users', [
            'firstName' => 'test'
        ]);
    }
}
