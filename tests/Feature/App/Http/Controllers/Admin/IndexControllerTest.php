<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\IndexController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_admin_page_success(): void
    {
        $this->get(action(IndexController::class))
            ->assertOk()
            ->assertViewIs('admin.index')
            ->assertSee('Панель администратора');
    }
}
