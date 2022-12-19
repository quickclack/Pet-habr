<?php

namespace Domain\Information\Queries;

use App\Contracts\QueryBuilder;
use Illuminate\Database\Eloquent\Collection;
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
            ->with(['category', 'tags'])
            ->where('user_id', auth()->id())
            ->where('status', ArticleStatus::APPROVED)
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

    public function getCountUserArticles(): int
    {
        return $this->getBuilder()
            ->where('user_id', auth('sanctum')->id())
            ->count();
    }
}
