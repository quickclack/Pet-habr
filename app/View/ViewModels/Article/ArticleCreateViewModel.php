<?php

namespace App\View\ViewModels\Article;

use Domain\Information\Queries\CategoryBuilder;
use Domain\Information\Queries\TagBuilder;
use Spatie\ViewModels\ViewModel;

class ArticleCreateViewModel extends ViewModel
{
    public function __construct(
        protected CategoryBuilder $categoryBuilder,
        protected TagBuilder $tagBuilder
    ){
    }

    public function categories(): array
    {
        return $this->categoryBuilder->getCategoryByPlug();
    }

    public function tags(): iterable
    {
        return $this->tagBuilder->getTagByPluck();
    }
}
