<?php

namespace App\Http\Resources\Api\Profile\Article;

use App\Http\Resources\Api\Category\CategoryResource;
use App\Http\Resources\Api\Tag\TagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'views' => $this->views,
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'status' => $this->status->name,
            'count_comments' => $this->comments()->count(),
            'created_at' => $this->setDate($this->created_at)
        ];
    }
}
