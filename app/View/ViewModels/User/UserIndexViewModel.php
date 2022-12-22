<?php

namespace App\View\ViewModels\User;

use Domain\User\Queries\UserBuilder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class UserIndexViewModel extends ViewModel
{
    public function __construct(
        protected UserBuilder $builder
    ){
    }

    public function users(): Collection
    {
        return $this->builder->getAllUsers();
    }
}
