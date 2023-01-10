<?php

namespace App\Http\Resources\Api\Profile\Notification;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'notifications' => $this->collection
        ];
    }
}
