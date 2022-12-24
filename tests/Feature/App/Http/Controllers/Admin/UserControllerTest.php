<?php

namespace Tests\Feature\App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\UserController;
use Database\Factories\Domain\User\Models\UserFactory;
use Domain\User\Models\Role;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    private function createUser(): User
    {
        $user = UserFactory::new()
            ->createOne();

        Sanctum::actingAs($user);

        $user->roles()->attach(Role::USER);

        return $user;
    }

    public function test_it_admin_users_page_success(): void
    {
        $this->get(action([UserController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.users.index')
            ->assertSee('Список Пользователей');
    }

    public function test_it_empty_admin_users_page_success(): void
    {
        $this->get(action([UserController::class, 'index']))
            ->assertOk()
            ->assertViewIs('admin.users.index')
            ->assertSee('Еще нет зарегистрированных пользователей');
    }

    public function test_it_get_admin_users_edit_page_success(): void
    {
        $user = $this->createUser();

        $this->get(action([UserController::class, 'edit'], $user->getKey()))
            ->assertOk()
            ->assertViewIs('admin.users.edit')
            ->assertSee('Редактировать: ' . $user->nickName);
    }
}
