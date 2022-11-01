<?php

namespace App\Http\Resources\Api\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'categories' => $this->collection
        ];
    }
}
