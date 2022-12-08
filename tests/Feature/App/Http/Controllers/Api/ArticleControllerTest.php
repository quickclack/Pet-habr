<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Http\Controllers\Api\ArticleController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    private function createArticle(): Collection
    {
        return ArticleFactory::new()
            ->count(10)
            ->create();
    }

    public function test_it_show_all_articles_success(): void
    {
        $this->createArticle();

        $this->post(action([ArticleController::class, 'getAllArticles']))
            ->assertOk();
    }

    public function test_it_show_one_article_success(): void
    {
        $article = ArticleFactory::new()
            ->createOne();

        $this->post(action([ArticleController::class, 'getArticleById'], $article->getKey()))
            ->assertOk()
            ->assertJsonPath('article.title', $article->title);
    }

    public function test_it_show_one_article_fail(): void
    {
        $this->post(action([ArticleController::class, 'getArticleById'], 500))
            ->assertJson(['message' => 'Такой статьи нет']);
    }

    public function test_it_search_response_success(): void
    {
        $article = $this->createArticle();

        $request = [
            'search' => $article->first()->title,
        ];

        $this->post(action([ArticleController::class, 'getAllArticles']), $request)
            ->assertOk()
            ->assertJsonCount(3);
    }

    public function test_it_empty_search_response_success(): void
    {
        $article = $this->createArticle();

        $request = [
            'search' => $article->random()->first()->title,
        ];

        $this->post(action([ArticleController::class, 'getAllArticles']), $request)
            ->assertOk()
            ->assertJsonCount(3)
            ->assertJson([
                'data' => [
                    'articles' => []
                ]
            ]);
    }

    public function test_it_not_transmitted_search_success(): void
    {
        $request = [
            'search' => '',
        ];

        $this->withoutExceptionHandling()
            ->post(action([ArticleController::class, 'getAllArticles']), $request)
            ->assertJson([
                "data" => [
                    "articles" => []
                ]
            ]);
    }
}
