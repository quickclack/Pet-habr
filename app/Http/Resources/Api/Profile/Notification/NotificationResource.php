<?php

namespace App\Http\Resources\Api\Profile\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'theme' => $this->notificationType->title,
            'message' => $this->when(request('notification'), fn() => $this->message),
            'date' => $this->created_at->format('d.m.Y'),
            'time' => $this->created_at->format('h:m'),
            'reads' => $this->reads ? 'Прочитано' : 'Не прочитано',
        ];
    }
}
