<?php

namespace App\Http\Resources\Api\Article;

use App\Http\Resources\Api\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'views' => $this->views,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d')
        ];
    }
}
