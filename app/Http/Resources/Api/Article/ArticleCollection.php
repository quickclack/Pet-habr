<?php

namespace App\Http\Resources\Api\Article;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'articles' => $this->collection
        ];
    }
}
