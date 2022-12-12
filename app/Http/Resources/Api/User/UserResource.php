<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'nickName' => $this->nickName,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'roles' => $this->getRole(),
            'email' => $this->email
        ];
    }
}
