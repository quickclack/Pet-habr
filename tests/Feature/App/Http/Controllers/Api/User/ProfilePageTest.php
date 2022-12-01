<?php

namespace Tests\Feature\App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\User\ProfileController;
use Database\Factories\Domain\Information\Models\CategoryFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfilePageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    private function createUser(): User
    {
        return UserFactory::new()->createOne();
    }

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

    public function test_can_auth_user_create_article(): void
    {
        $category = CategoryFactory::new()->createOne();

        $user = $this->createUser();

        $this->actingAs($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        $request = [
            'title' => 'Test',
            'description' => 'Test',
            'category_id' => $category->getKey(),
            'image' => UploadedFile::fake()->image('image.jpg', 1, 1)
        ];

        $this->post(action([ProfileController::class, 'createArticle']), $request, ['Authenticated' => 'Bearer' . $token])
            ->assertOk();

        $this->assertDatabaseHas('articles', [
            'description' => 'Test',
        ]);
    }
}
