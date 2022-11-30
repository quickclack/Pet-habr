<?php

namespace App\Http\Resources\Api\Tag;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'tags' => $this->collection
        ];
    }
}
