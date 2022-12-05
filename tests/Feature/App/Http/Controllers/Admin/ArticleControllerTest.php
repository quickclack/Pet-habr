<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\ArticleController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\Information\Models\CategoryFactory;
use Domain\Information\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    private function getRequest(): array
    {
        $category = CategoryFactory::new()
            ->createOne();

        return [
            'title' => 'Test',
            'description' => 'Test',
            'category_id' => $category->getKey(),
        ];
    }

    private function createArticle(int $status): Article
    {
        return ArticleFactory::new()
            ->createOne([
                'status' => $status
            ]);
    }

    public function test_it_admin_articles_page_success(): void
    {
        $this->get(action([ArticleController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.article.index')
            ->assertSee('Список статей');
    }

    public function test_it_empty_articles_page_success(): void
    {
        $this->get(action([ArticleController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.article.index')
            ->assertSee('Статей пока нет..');
    }

    public function test_it_get_all_article_success(): void
    {
        $expectedArticle = $this->createArticle(5);

        $this->get(action([ArticleController::class, 'index']))
            ->assertOk()
            ->assertSee($expectedArticle->title);
    }

    public function test_it_get_new_article_success(): void
    {
        $expectedArticle = $this->createArticle(0);

        $this->get(action([ArticleController::class, 'show'], ['article' => $expectedArticle->getKey()]))
            ->assertOk()
            ->assertViewIs('admin.article.new')
            ->assertSee($expectedArticle->title);
    }

    public function test_it_get_empty_trash_article_success(): void
    {
        $this->get(action([ArticleController::class, 'trash']))
            ->assertOk()
            ->assertSee('Список отклонённых статей')
            ->assertViewIs('admin.article.trash');
    }

    public function test_it_get_trash_article_success(): void
    {
        $expectedArticles = $this->createArticle(10);

        $this->get(action([ArticleController::class, 'trash']))
            ->assertSee($expectedArticles->title);
    }

    public function test_it_get_create_article_page_success(): void
    {
        $this->get(action([ArticleController::class, 'create']))
            ->assertOk()
            ->assertViewIs('admin.article.create')
            ->assertSee('Добавить статью');
    }

    public function test_it_article_success_create(): void
    {
        $this->post(action([ArticleController::class, 'store']), $this->getRequest());

        $this->assertDatabaseHas('articles', [
            'title' => 'Test',
        ]);
    }

    public function test_it_get_edit_article_page_success(): void
    {
        $article = $this->createArticle(5);

        $this->get(action([ArticleController::class, 'edit'], $article->getKey()))
            ->assertOk()
            ->assertViewIs('admin.article.edit')
            ->assertSee('Редактировать: ' . $article->title);
    }

    public function test_it_article_success_update(): void
    {
        $article = ArticleFactory::new()
            ->createOne();

        $this->put(action([ArticleController::class, 'update'], $article->getKey()), $this->getRequest());

        $this->assertDatabaseHas('articles', [
            'title' => 'Test',
        ]);
    }

    public function test_it_article_success_destroy(): void
    {
        $article = $this->createArticle(5);

        $this->delete(action([ArticleController::class, 'destroy'], $article->getKey()));

        $this->assertDatabaseMissing('articles', [
            'id' => $article->getKey()
        ]);
    }

    public function test_it_article_success_approve(): void
    {
        $article = $this->createArticle(0);

        $this->post(action([ArticleController::class, 'approve'], $article->getKey()));

        $this->assertDatabaseHas('articles', [
            'id' => $article->getKey(),
            'status' => 5
        ]);
    }

    public function test_it_article_success_reject(): void
    {
        $article = $this->createArticle(0);

        $this->post(action([ArticleController::class, 'reject'], $article->getKey()));

        $this->assertDatabaseHas('articles', [
            'id' => $article->getKey(),
            'status' => 10
        ]);
    }
}
