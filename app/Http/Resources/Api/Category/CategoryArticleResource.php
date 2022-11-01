<?php

namespace App\Http\Resources\Api\Category;

use App\Http\Resources\Api\Article\ArticleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'articles' => ArticleResource::collection($this->articles),
        ];
    }
}
