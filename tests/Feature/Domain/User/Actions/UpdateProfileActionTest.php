<?php

namespace Tests\Feature\Domain\User\Actions;

use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Actions\Contracts\UpdateProfileContract;
use Domain\User\DTO\UpdateProfileDto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateProfileActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_it_success_profile_updated(): void
    {
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
