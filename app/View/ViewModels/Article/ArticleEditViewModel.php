<?php

namespace App\View\ViewModels\Article;

use Domain\Information\Models\Article;
use Domain\Information\Queries\CategoryBuilder;
use Domain\Information\Queries\TagBuilder;
use Spatie\ViewModels\ViewModel;

class ArticleEditViewModel extends ViewModel
{
    public function __construct(
        protected Article $article,
        protected CategoryBuilder $categoryBuilder,
        protected TagBuilder $tagBuilder
    ){
    }

    public function article(): Article
    {
        return $this->article;
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
