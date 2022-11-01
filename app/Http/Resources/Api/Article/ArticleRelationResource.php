<?php

namespace App\Http\Resources\Api\Article;

use App\Http\Resources\Api\Category\CategoryResource;
use App\Http\Resources\Api\Tag\TagResource;
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
            'user' => $this->user, // later Resource
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
