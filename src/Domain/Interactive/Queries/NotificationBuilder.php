<?php

namespace Domain\Interactive\Queries;

use App\Contracts\QueryBuilder;
use Domain\Interactive\Models\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class NotificationBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Notification::query();
    }

    public function getAll(): Collection
    {
        return $this->getBuilder()
            ->with('notificationType')
            ->where('user_id', auth('sanctum')->id())
            ->get();
    }
}
