<?php

namespace App\Http\Resources\Api\Profile\Comment;

use Domain\User\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'article_id' => $this->article_id ?? $this->getArticleFields('id', $this->parent_id),
            'article_title' => $this->article->title ?? $this->getArticleFields('title', $this->parent_id),
            'comment' => $this->comment,
            'created_at' => $this->setDate($this->created_at),
            'user_avatar' => $this->user->avatar,
            'user_name' => $this->user->nickName,
        ];
    }

    private function getArticleFields(string $flag, int $id): int|string
    {
        $comment = Comment::query()
            ->select('article_id')
            ->where('id', $id)
            ->first();

        return match ($flag) {
            'id' => $comment->article_id,
            'title' => $comment->article->title
        };
    }
}
