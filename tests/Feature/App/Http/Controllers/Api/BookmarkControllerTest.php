<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Http\Controllers\Api\BookmarkController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BookmarkControllerTest extends TestCase
{
    use RefreshDatabase;

    private function getUser(): User
    {
        $user = UserFactory::new()
            ->createOne();

        Sanctum::actingAs($user);

        return $user;
    }

    public function test_it_toggle_article_success(): void
    {
        $user = $this->getUser();

        $article = ArticleFactory::new()
            ->createOne();

        $this->post(action([BookmarkController::class, 'toggle'], $article->getKey()))
            ->assertOk();

        $this->assertDatabaseHas('bookmarks', [
            'user_id' => $user->getKey(),
            'article_id' => $article->getKey()
        ]);

        $this->post(action([BookmarkController::class, 'toggle'], $article->getKey()))
            ->assertOk();

        $this->assertDatabaseMissing('bookmarks', [
            'user_id' => $user->getKey(),
            'article_id' => $article->getKey()
        ]);
    }
}
