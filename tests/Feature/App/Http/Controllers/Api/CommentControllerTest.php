<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Http\Controllers\Api\CommentController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\User\Models\CommentFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_comments_for_article_success(): void
    {
        $user = UserFactory::new()
            ->createOne();

        $article = ArticleFactory::new()
            ->createOne();

        CommentFactory::new()->count(5)->create([
            'comment' => fake()->text(),
            'article_id' => $article->getKey(),
            'user_id' => $user->getKey()
        ]);

        $this->post(action([CommentController::class, 'getCommentsOnArticle'], $article->getKey()))
            ->assertOk();
    }
}
