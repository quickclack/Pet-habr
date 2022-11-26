<?php

namespace App\Http\Resources\Api\Comment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'comments' => $this->collection
        ];
    }
}
