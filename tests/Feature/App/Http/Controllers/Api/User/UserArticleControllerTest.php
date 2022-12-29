<?php

namespace Tests\Feature\App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\User\UserArticleController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Database\Factories\Domain\Information\Models\CategoryFactory;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\Information\Models\Article;
use Domain\Information\Models\Category;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Support\Enums\ArticleStatus;
use Tests\TestCase;

class UserArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    private function createUser(): User
    {
        return UserFactory::new()->createOne();
    }

    private function createCategory(): Category
    {
        return CategoryFactory::new()
            ->createOne();
    }

    private function getToken(User $user): array
    {
        $token = $user->createToken('auth_token')->plainTextToken;

        return  [
            'Authenticated' => 'Bearer' . $token
        ];
    }

    private function request(Category $category): array
    {
        return [
            'title' => 'Test',
            'description' => 'Test',
            'category_id' => $category->getKey(),
        ];
    }

    private function createArticle(User $user): Article
    {
        return ArticleFactory::new()
            ->createOne(['user_id' => $user->getKey()]);
    }

    public function test_it_get_user_articles_success(): void
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        ArticleFactory::new()->count(5)
            ->create(['user_id' => $user->getKey()]);

        $this->post(action([UserArticleController::class, 'getAll']), $this->getToken($user))
            ->assertOk()
            ->assertJsonCount(3);
    }

    public function test_can_auth_user_create_article(): void
    {
        $category = $this->createCategory();

        $user = $this->createUser();

        Sanctum::actingAs($user);

        $this->post(action([UserArticleController::class, 'create']), $this->request($category), $this->getToken($user))
            ->assertOk();

        $this->assertDatabaseHas('articles', [
            'description' => 'Test',
            'user_id' => $user->getKey()
        ]);
    }

    public function test_it_not_added_views_success(): void
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        $article = ArticleFactory::new()->createOne([
            'views' => 2
        ]);

        $this->post(action([UserArticleController::class, 'getById'], $article->getKey()))
            ->assertOk();

        $this->assertEquals('2', $article->views);
    }

    public function test_it_can_user_article_update_success(): void
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        $category = $this->createCategory();

        $article = $this->createArticle($user);

        $this->put(action([UserArticleController::class, 'update'], $article->getKey()), $this->request($category), $this->getToken($user))
            ->assertOk()
            ->assertJson(['message' => 'Статья успешно обновлена и отправлена на модерацию']);

        $this->assertDatabaseHas('articles', [
            'id' => $article->getKey(),
            'user_id' => $user->getKey(),
            'status' => ArticleStatus::NEW
        ]);
    }

    public function test_it_can_user_article_delete_success(): void
    {
        $user = $this->createUser();

        Sanctum::actingAs($user);

        $article = $this->createArticle($user);

        $this->delete(action([UserArticleController::class, 'destroy'], $article->getKey()), $this->getToken($user))
            ->assertOk()
            ->assertJson([
                'status' => 200,
                'message' => 'Статья успешно удален(а)',
            ]);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->getKey()
        ]);
    }
}
