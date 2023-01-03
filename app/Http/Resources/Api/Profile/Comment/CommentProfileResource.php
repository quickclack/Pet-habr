<?php

namespace App\Http\Resources\Api\Profile\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'article_id' => $this->article->id,
            'comment' => $this->comment,
            'created_at' => $this->setDate($this->created_at),
            'user_avatar' => $this->user->avatar,
            'user_nick_name' => $this->user->nickName,
        ];
    }
}
