<?php

namespace App\Http\Resources\Api\Profile\Article;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleProfileCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'articles' => $this->collection
        ];
    }
}
