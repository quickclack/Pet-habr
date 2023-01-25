<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\View\ViewModels\User\UserEditViewModel;
use App\View\ViewModels\User\UserIndexViewModel;
use App\View\ViewModels\User\UserShowViewModel;
use Domain\User\Models\User;
use Domain\User\Queries\UserBuilder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserBuilder $builder): UserIndexViewModel
    {
        return (new UserIndexViewModel($builder))
            ->view('admin.users.index');
    }

    public function show(): UserShowViewModel
    {
        return (new UserShowViewModel())
            ->view('admin.users.banned');
    }

    public function edit(User $user): UserEditViewModel
    {
        return (new UserEditViewModel($user))
            ->view('admin.users.edit');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        user()->update(request: $request, user: $user);

        flash()->success('Пользователь успешно обновлен');

        return to_route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        user()->destroy(user: $user);

        flash()->success('Пользователь успешно обновлен');

        return to_route('admin.users.index');
    }
}
