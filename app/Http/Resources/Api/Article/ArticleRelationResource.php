<?php

namespace App\Http\Resources\Api\Article;

use App\Http\Resources\Api\Category\CategoryResource;
use App\Http\Resources\Api\Tag\TagResource;
use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleRelationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'views' => $this->views,
            'likes' => $this->likes[0]->quantity ?? 0,
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
