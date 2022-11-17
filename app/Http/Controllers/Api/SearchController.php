<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\Api\Article\ArticleCollection;
use Domain\Information\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request): ArticleCollection
    {
        $articles = Article::query()
            ->with('user')
            ->when($request->search, function (Builder $builder) use ($request) {
                $builder->whereFullText(['title', 'description'], $request->search);
            })->paginate(5);

        return new ArticleCollection($articles);
    }
}
