<?php

namespace App\View\ViewModels\User;

use Domain\User\Models\Banned;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class UserShowViewModel extends ViewModel
{
    public function banned(): LengthAwarePaginator
    {
        return Banned::query()
            ->with('user')
            ->paginate(10);
    }
}
