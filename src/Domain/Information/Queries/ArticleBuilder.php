<?php

declare(strict_types=1);

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Support\Enums\ArticleStatus;
use Domain\Information\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
            ->with(['user'])
            ->where('status', ArticleStatus::APPROVED)
            ->filter()
            ->sorted()
            ->search()
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

    public function getUserArticles(): LengthAwarePaginator
    {
        return $this->getBuilder()
            ->with(['category', 'tags', 'user'])
            ->where('user_id', auth()->id())
            ->when(request('status'), fn(Builder $builder) => $builder->where('status', request('status')))
            ->when(!request('status'), fn(Builder $builder) => $builder->where('status', ArticleStatus::APPROVED))
            ->orderByDesc('created_at')
            ->paginate(5);
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
