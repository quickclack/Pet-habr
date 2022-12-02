<?php

namespace App\View\ViewModels\Tag;

use Domain\Information\Models\Tag;
use Spatie\ViewModels\ViewModel;

class TagEditViewModel extends ViewModel
{
    public function __construct(
        protected Tag $tag
    ){
    }

    public function tag(): Tag
    {
        return $this->tag;
    }
}
