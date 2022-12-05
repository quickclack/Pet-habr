<?php

namespace App\Http\Resources\Api\Profile\Article;

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
            'count_comments' => $this->comments()->count(),
            'created_at' => "{$this->setDate($this)} в {$this->created_at->format('h:m')}"
        ];
    }
}
