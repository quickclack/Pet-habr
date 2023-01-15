<?php

namespace Domain\Interactive\Models;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Support\Enums\NotificationType as NotificationEnum;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_type_id',
        'article_id',
        'comment_id',
        'message',
        'reads'
    ];

    protected $casts = [
        'reads' => 'boolean',
        'notification_type_id' => NotificationEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function notificationType(): HasOne
    {
        return $this->hasOne(NotificationType::class, 'id', 'notification_type_id');
    }
}
