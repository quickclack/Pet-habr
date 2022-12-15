<?php

namespace Support\Enums;

enum ArticleStatus: int
{
    case NEW = 0;
    case APPROVED = 5;
    case REJECTED = 10;

    public function getStatus(): string
    {
        return match ($this) {
            self::NEW => 'Новая',
            self::APPROVED => 'Подтверждена',
            self::REJECTED => 'Отклонена',
        };
    }
}
