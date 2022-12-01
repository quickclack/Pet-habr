<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CategoryController;
use Database\Factories\Domain\Information\Models\CategoryFactory;
use Domain\Information\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function getRequest(): array
    {
        return [
            'title' => 'Test'
        ];
    }

    private function createCategory(): Category
    {
        return CategoryFactory::new()
            ->createOne();
    }

    public function test_it_admin_category_page_success(): void
    {
        $this->get(action([CategoryController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.category.index')
            ->assertSee('Список категорий');
    }

    public function test_it_empty_category_page_success(): void
    {
        $this->get(action([CategoryController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.category.index')
            ->assertSee('Категорий пока нет..');
    }

    public function test_it_get_all_category_success(): void
    {
        $expectedCategory = $this->createCategory();

        $this->get(action([CategoryController::class, 'index']))
            ->assertOk()
            ->assertSee($expectedCategory->title);
    }

    public function test_it_get_create_category_page_success(): void
    {
        $this->get(action([CategoryController::class, 'create']))
            ->assertOk()
            ->assertViewIs('admin.category.create')
            ->assertSee('Добавить категорию');
    }

    public function test_it_category_success_create(): void
    {
        $this->post(action([CategoryController::class, 'store']), $this->getRequest());

        $this->assertDatabaseHas('categories', [
            'title' => 'Test',
        ]);
    }

    public function test_it_get_edit_category_page_success(): void
    {
        $category = $this->createCategory();

        $this->get(action([CategoryController::class, 'edit'], $category->getKey()))
            ->assertOk()
            ->assertViewIs('admin.category.edit')
            ->assertSee('Редактировать: ' . $category->title);
    }

    public function test_it_category_success_update(): void
    {
        $category = $this->createCategory();

        $this->put(action([CategoryController::class, 'update'], $category->getKey()), $this->getRequest());

        $this->assertDatabaseHas('categories', [
            'title' => 'Test',
        ]);
    }

    public function test_it_category_success_destroy(): void
    {
        $category = $this->createCategory();

        $this->delete(action([CategoryController::class, 'destroy'], $category->getKey()));

        $this->assertDatabaseMissing('articles', [
            'id' => $category->getKey()
        ]);
    }
}
