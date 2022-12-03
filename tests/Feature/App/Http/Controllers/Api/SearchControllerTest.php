<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use App\Http\Controllers\Api\SearchController;
use Database\Factories\Domain\Information\Models\ArticleFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    private function createArticle(): Collection
    {
        return ArticleFactory::new()
            ->count(10)
            ->create();
    }

    public function test_it_search_response_success(): void
    {
        $article = $this->createArticle();

        $request = [
            'search' => $article->first()->title,
        ];

        $this->post(action(SearchController::class), $request)
            ->assertOk()
            ->assertJsonCount(3);
    }

    public function test_it_empty_search_response_success(): void
    {
        $article = $this->createArticle();

        $request = [
            'search' => $article->random()->first()->title,
        ];

        $this->post(action(SearchController::class), $request)
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
        $this->expectException(ValidationException::class);

        $request = [
            'search' => '',
        ];

        $this->withoutExceptionHandling()
            ->post(action(SearchController::class), $request)
            ->assertJson(['message' => 'Поле search обязательно для заполнения.']);
    }
}
