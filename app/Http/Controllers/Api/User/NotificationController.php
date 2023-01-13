<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Profile\Notification\NotificationCollection;
use App\Http\Resources\Api\Profile\Notification\NotificationResource;
use Domain\Interactive\Models\Notification;
use Domain\Interactive\Queries\NotificationBuilder;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationBuilder $builder
    ){
    }

    public function getAll(): NotificationCollection
    {
        return new NotificationCollection($this->builder->getAll());
    }

    public function getById(Notification $notification): JsonResponse
    {
        $this->addReads($notification);

        return response()->json([
            'notification' => new NotificationResource($notification)
        ]);
    }

    private function addReads(Notification $notification): void
    {
        $notification->reads = true;

        $notification->save();
    }
}
