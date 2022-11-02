<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'users' => $this->collection
        ];
    }
}
