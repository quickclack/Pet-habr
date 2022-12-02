<?php

namespace App\View\ViewModels\Tag;

use Domain\Information\Queries\TagBuilder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class TagIndexViewModel extends ViewModel
{
    public function __construct(
        protected TagBuilder $builder
    ){
    }

    public function tags(): Collection
    {
        return $this->builder->getAllTags();
    }
}
