<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use Database\Factories\Domain\Information\Models\ArticleFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_show_all_articles_success(): void
    {
        ArticleFactory::new()
            ->count(5)
            ->create();

        $this->post('api/articles')
            ->assertOk();
    }

    public function test_it_show_one_article_success(): void
    {
        $article = ArticleFactory::new()->createOne([
            'id' => '1',
            'title' => 'test'
        ]);

        $this->post('/api/article/1')
            ->assertOk()
            ->assertJsonPath('article.title', $article->title);
    }

    public function test_it_show_one_article_fail(): void
    {
        $this->post('/api/article/500')
            ->assertJson(['message' => 'Такой статьи нет']);
    }
}
