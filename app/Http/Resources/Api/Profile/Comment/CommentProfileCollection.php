<?php

namespace App\Http\Resources\Api\Profile\Comment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentProfileCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'comments' => $this->collection,
        ];
    }
}
