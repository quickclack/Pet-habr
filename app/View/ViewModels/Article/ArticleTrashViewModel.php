<?php

namespace App\View\ViewModels\Article;

use Domain\Information\Queries\ArticleBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;
use Support\Enums\ArticleStatus;

class ArticleTrashViewModel extends ViewModel
{
    public function __construct(
        protected ArticleBuilder $builder
    ){
    }

    public function articles(): LengthAwarePaginator
    {
        return $this->builder->getArticlesWithPaginate(ArticleStatus::REJECTED);
    }
}
