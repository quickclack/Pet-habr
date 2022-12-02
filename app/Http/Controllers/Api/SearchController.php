<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\Api\Article\ArticleCollection;
use Domain\Information\Queries\ArticleBuilder;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request, ArticleBuilder $builder): ArticleCollection
    {
        return new ArticleCollection(
            $builder->getArticlesBySearch($request)
        );
    }
}
