<?php

namespace App\Http\Resources\Api\Comment;

use Illuminate\Http\Resources\Json\JsonResource;
use Support\Traits\HasLikeable;

class CommentResource extends JsonResource
{
    use HasLikeable;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'likes' => $this->likes()->count(),
            'auth_liked' => $this->getBoolean($this->likes()),
            'comment' => $this->comment,
            'user_name' => $this->user->nickName,
            'avatar' => $this->user->avatar ?? null,
            'created_at' => $this->setDate($this->created_at),
            'replies_comment' => $this->when($this->replies()->count() > 0, function () {
                return $this->replies()
                    ->with('user')
                    ->get()
                    ->map(fn($item) => [
                        'id' => $item->id,
                        'comment' => $item->comment,
                        'user_id' => $item->user->id,
                        'likes' => $this->likes()->count(),
                        'user_name' => $item->user->nickName,
                        'avatar' => $this->user->avatar ?? null,
                        'parent_id' => $this->id,
                        'created_at' => $this->setDate($item->created_at)
                    ])->toArray();
            }),
        ];
    }
}
