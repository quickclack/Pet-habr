<?php

namespace App\View\ViewModels\Category;

use Domain\Information\Queries\CategoryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class CategoryIndexViewModel extends ViewModel
{
    public function __construct(
       protected CategoryBuilder $categoryBuilder
    ){
    }

    public function categories(): Collection
    {
        return $this->categoryBuilder->getAllCategories();
    }
}
