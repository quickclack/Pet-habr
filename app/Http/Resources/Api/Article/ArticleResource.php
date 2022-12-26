<?php

namespace App\Http\Resources\Api\Article;

use Illuminate\Http\Resources\Json\JsonResource;
use Support\Traits\HasBoolean;

class ArticleResource extends JsonResource
{
    use HasBoolean;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user_name' => $this->user->nickName ?? 'Без автора',
            'avatar' => $this->user->avatar ?? null,
            'views' => $this->views,
            'likes' => $this->likes()->count(),
            'auth_liked' => $this->getBoolean($this->likes()),
            'auth_bookmarks' => $this->getBoolean($this->bookmarks()),
            'count_comments' => $this->comments()->count(),
            'count_bookmarks' => $this->getCountBookmarks(),
            'image' => $this->when($this->image, fn() => $this->image),
            'created_at' => $this->setDate($this->created_at),
        ];
    }
}
