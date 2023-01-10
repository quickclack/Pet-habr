<?php

namespace Support\Enums;

enum NotificationType: int
{
    case Systems = 1;
    case Services = 2;

    public function getStatus(): string
    {
        return match ($this) {
            self::Systems => 'Системные уведомления',
            self::Services => 'Служебные оповещения',
        };
    }
}
