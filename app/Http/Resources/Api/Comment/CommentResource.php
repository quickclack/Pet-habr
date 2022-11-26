<?php

namespace App\Http\Resources\Api\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'user_name' => $this->user->nickName,
            'created_at' => "{$this->setDate($this)} в {$this->created_at->format('h:m')}",
        ];
    }
}
