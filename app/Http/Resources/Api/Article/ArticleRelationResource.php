<?php

namespace App\Http\Resources\Api\Article;

use App\Http\Resources\Api\Category\CategoryResource;
use App\Http\Resources\Api\Tag\TagResource;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Support\Traits\HasLikeable;

class ArticleRelationResource extends JsonResource
{
    use HasLikeable;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'views' => $this->views,
            'likes' => $this->likes()->count(),
            'auth_liked' => $this->getBoolean($this->likes()),
            'count_comments' => $this->comments()->count(),
            'user' => new UserResource($this->user),
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'status' => $this->status->getStatus(),
            'image' => $this->when($this->image, fn() => $this->image),
            'created_at' => $this->setDate($this->created_at),
        ];
    }
}
