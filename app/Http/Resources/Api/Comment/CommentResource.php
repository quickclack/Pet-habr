<?php

namespace App\Http\Resources\Api\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->id,
            'comment' => $this->comment,
            'user_name' => $this->user->nickName,
            'created_at' => "{$this->setDate($this)} в {$this->created_at->format('h:m')}",
            'replies_comment' => $this->when($this->replies()->count() > 0, function () {
                return $this->replies()
                    ->get()
                    ->map(fn($item) => [
                        'id' => $item->id,
                        'comment' => $item->comment,
                        'user_id' => $item->user->id,
                        'user_name' => $item->user->nickName,
                        'parent_id' => $this->id,
                        'created_at' => "{$this->setDate($item)} в {$item->created_at->format('h:m')}"
                    ])->toArray();
            }),
        ];
    }
}
