<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\TagController;
use Database\Factories\Domain\Information\Models\TagFactory;
use Domain\Information\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagControllerTest extends TestCase
{
    use RefreshDatabase;

    private function getRequest(): array
    {
        return [
            'title' => 'Test'
        ];
    }

    private function createTag(): Tag
    {
        return TagFactory::new()
            ->createOne();
    }

    public function test_it_admin_category_page_success(): void
    {
        $this->get(action([TagController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.tag.index')
            ->assertSee('Список тегов');
    }

    public function test_it_empty_category_page_success(): void
    {
        $this->get(action([TagController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.tag.index')
            ->assertSee('Тегов пока нет..');
    }

    public function test_it_get_all_category_success(): void
    {
        $expectedCategory = $this->createTag();

        $this->get(action([TagController::class, 'index']))
            ->assertOk()
            ->assertSee($expectedCategory->title);
    }

    public function test_it_get_create_category_page_success(): void
    {
        $this->get(action([TagController::class, 'create']))
            ->assertOk()
            ->assertViewIs('admin.tag.create')
            ->assertSee('Добавить тег');
    }

    public function test_it_category_success_create(): void
    {
        $this->post(action([TagController::class, 'store']), $this->getRequest());

        $this->assertDatabaseHas('tags', [
            'title' => 'Test',
        ]);
    }

    public function test_it_get_edit_category_page_success(): void
    {
        $tag = $this->createTag();

        $this->get(action([TagController::class, 'edit'], $tag->getKey()))
            ->assertOk()
            ->assertViewIs('admin.tag.edit')
            ->assertSee('Редактировать: ' . $tag->title);
    }

    public function test_it_category_success_update(): void
    {
        $tag = $this->createTag();

        $this->put(action([TagController::class, 'update'], $tag->getKey()), $this->getRequest());

        $this->assertDatabaseHas('tags', [
            'title' => 'Test',
        ]);
    }

    public function test_it_category_success_destroy(): void
    {
        $tag = $this->createTag();

        $this->delete(action([TagController::class, 'destroy'], $tag->getKey()));

        $this->assertDatabaseMissing('tags', [
            'id' => $tag->getKey()
        ]);
    }
}
