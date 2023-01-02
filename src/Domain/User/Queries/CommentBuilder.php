<?php

namespace Domain\User\Queries;

use App\Contracts\QueryBuilder;
use Domain\User\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class CommentBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Comment::query();
    }

    public function getCommentsOnArticle(int $id): Collection
    {
        return $this->getBuilder()
            ->with(['user', 'replies'])
            ->select(['id', 'comment', 'created_at', 'user_id'])
            ->where('article_id', $id)
            ->get();
    }

    public function getCommentById(int $id): ?Model
    {
        return $this->getBuilder()
            ->findOrFail($id);
   }

   public function getCommentByCurrentUser(): LengthAwarePaginator
   {
       return $this->getBuilder()
           ->with(['article', 'user'])
           ->where('user_id', auth('sanctum')->id())
           ->paginate(5);
   }
}
