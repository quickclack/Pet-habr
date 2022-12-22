<?php

namespace App\View\ViewModels\User;

use Domain\User\Models\Role;
use Domain\User\Models\User;
use Spatie\ViewModels\ViewModel;

class UserEditViewModel extends ViewModel
{
    public function __construct(
        protected User $user
    ){
    }

    public function user(): User
    {
        return $this->user;
    }

    public function roles(): array
    {
        return Role::query()
            ->select(['id', 'name'])
            ->pluck('name', 'id')
            ->all();
    }
}
