<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Http\Controllers\Api\LikeController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\User\Models\CommentFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function getUser(): User
    {
        return UserFactory::new()
            ->createOne();
    }

    public function test_it_toggle_article_success(): void
    {
        $user = $this->getUser();

        $article = ArticleFactory::new()
            ->createOne();

        Sanctum::actingAs($user);

        $this->post(action([LikeController::class, 'toggleArticle'], $article->getKey()))
            ->assertOk();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->getKey(),
            'article_id' => $article->getKey()
        ]);

        $this->post(action([LikeController::class, 'toggleArticle'], $article->getKey()))
            ->assertOk();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->getKey(),
            'article_id' => $article->getKey()
        ]);
    }

    public function test_it_toggle_comment_success(): void
    {
        $user = $this->getUser();

        $comment = CommentFactory::new()
            ->createOne();

        Sanctum::actingAs($user);

        $this->post(action([LikeController::class, 'toggleComment'], $comment->getKey()))
            ->assertOk();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->getKey(),
            'comment_id' => $comment->getKey()
        ]);

        $this->post(action([LikeController::class, 'toggleComment'], $comment->getKey()))
            ->assertOk();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->getKey(),
            'comment_id' => $comment->getKey()
        ]);
    }
}
