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
            'sex' => $this->sex,
            'description' => $this->description,
            'avatar' => $this->avatar ?? null,
            'roles' => $this->getRole(),
            'email' => $this->email
        ];
    }
}
