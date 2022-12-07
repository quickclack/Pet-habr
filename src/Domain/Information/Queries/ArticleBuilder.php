<?php

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Support\Enums\ArticleStatus;
use Domain\Information\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

final class ArticleBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Article::query();
    }

    public function getAllApprovedArticles(): LengthAwarePaginator
    {
        return $this->getBuilder()
            ->with('user')
            ->where('status', ArticleStatus::APPROVED)
            ->filter()
            ->sorted()
            ->paginate(5);
    }

    public function getArticlesWithPaginate(ArticleStatus $status): LengthAwarePaginator
    {
        return $this->getBuilder()
            ->with(['user', 'category'])
            ->where('status', $status)
            ->paginate(20);
    }

    public function getArticleById(int $id): ?Model
    {
        return $this->getBuilder()
            ->with(['user', 'category', 'tags'])
            ->where('id', $id)
            ->first();
    }

    public function getUserArticleById(int $id): ?Model
    {
        return $this->getBuilder()
            ->with(['user', 'category', 'tags'])
            ->where('id', $id)
            ->first();
    }

    public function getArticlesBySearch(FormRequest $request): LengthAwarePaginator
    {
        return $this->getBuilder()
            ->with('user')
            ->when($request->search, function (Builder $builder) use ($request) {
                $builder->whereFullText(['title', 'description'], $request->search);
            })->paginate(5);
    }

    public function getUserArticles(): Collection
    {
        return $this->getBuilder()
            ->where('user_id', auth()->id())
            ->where('status', ArticleStatus::APPROVED)
            ->get();
    }

    public function getCountNewArticles(): int
    {
        return $this->getBuilder()
            ->where('status', ArticleStatus::NEW)
            ->count();
    }

    public function getCountRejectedArticles(): int
    {
        return $this->getBuilder()
            ->where('status', ArticleStatus::REJECTED)
            ->count();
    }
}
