<?php

namespace Tests\Feature\App\Http\Controllers\Api;

use Database\Factories\Domain\Information\Models\CategoryFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_show_all_categories_success(): void
    {
        CategoryFactory::new()
            ->count(5)
            ->create();

        $this->post('api/categories')
            ->assertOk();
    }

    public function test_it_show_one_category_success(): void
    {
        $category = CategoryFactory::new()->createOne([
            'title' => 'test',
            'slug' => 'test'
        ]);

        $this->post('/api/category/test')
            ->assertOk()
            ->assertJsonPath('category.title', $category->title);
    }

    public function test_it_show_one_category_fail(): void
    {
        $this->post('/api/category/fail')
            ->assertJson(['message' => 'Нет такой категории']);
    }
}
