<?php

namespace Domain\User\Queries;

use App\Contracts\QueryBuilder;
use Domain\User\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

final class CommentBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Comment::query();
    }

    public function getCommentsOnArticle(int $id): Collection
    {
        return $this->getBuilder()
            ->with('user')
            ->select(['id', 'comment', 'created_at', 'user_id'])
            ->where('article_id', $id)
            ->get();
    }
}
