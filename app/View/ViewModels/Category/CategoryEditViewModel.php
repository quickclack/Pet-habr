<?php

namespace App\View\ViewModels\Category;

use Domain\Information\Models\Category;
use Spatie\ViewModels\ViewModel;

class CategoryEditViewModel extends ViewModel
{
    public function __construct(
       protected Category $category
    ){
    }

    public function category(): Category
    {
        return $this->category;
    }
}
