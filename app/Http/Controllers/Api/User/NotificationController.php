<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Profile\Notification\NotificationCollection;
use App\Http\Resources\Api\Profile\Notification\NotificationResource;
use Domain\Interactive\Models\Notification;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function getAll(): NotificationCollection
    {
        $notifications = Notification::query()
            ->with('notificationType')
            ->where('user_id', auth('sanctum')->id())
            ->get();

        return new NotificationCollection($notifications);
    }

    public function getById(Notification $notification): JsonResponse
    {
        return response()->json([
            'notification' => new NotificationResource($notification)
        ]);
    }
}
