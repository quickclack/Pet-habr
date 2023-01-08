<?php

namespace App\Http\Resources\Api\Profile\Article;

use App\Http\Resources\Api\Category\CategoryResource;
use App\Http\Resources\Api\Tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Support\Traits\HasBoolean;

class ArticleProfileResource extends JsonResource
{
    use HasBoolean;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user_name' => $this->user->nickName,
            'avatar' => $this->user->avatar,
            'image' => $this->image,
            'views' => $this->views,
            'likes' => $this->likes()->count(),
            'auth_liked' => $this->getBoolean($this->likes()),
            'auth_bookmarks' => $this->getBoolean($this->bookmarks()),
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'status' => $this->status->getStatus(),
            'count_comments' => $this->comments()->count(),
            'count_bookmarks' => $this->getCountBookmarks(),
            'created_at' => $this->setDate($this->created_at)
        ];
    }
}
