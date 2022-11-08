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
            'user' => new UserResource($this->user),
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'status' => $this->status,
            'created_at' => "{$this->setArticleDate()} в {$this->created_at->format('h:m')}",
        ];
    }
}
