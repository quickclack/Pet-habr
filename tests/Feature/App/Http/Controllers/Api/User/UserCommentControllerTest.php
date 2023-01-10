<?php

namespace Tests\Feature\App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\User\UserCommentController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\User\Models\CommentFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserCommentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    private function getToken(User $user): array
    {
        $token = $user->createToken('auth_token')->plainTextToken;

        return  [
            'Authenticated' => 'Bearer' . $token
        ];
    }

    public function test_it_get_all_comments_success(): void
    {
        $user = UserFactory::new()
            ->createOne();

        Sanctum::actingAs($user);

        $article = ArticleFactory::new()
            ->createOne();

        $comments = CommentFactory::new()
            ->count(10)
            ->create([
                'user_id' => $user->getKey(),
                'article_id' => $article->getKey(),
            ]);

        $this->post(action([UserCommentController::class, 'getAll']), $this->getToken($user))
            ->assertOk();

        $this->assertEquals($user->getKey(), $user->getKey());

        $this->assertEquals(10, $comments->count());
    }
}
