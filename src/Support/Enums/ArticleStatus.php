<?php

namespace Support\Enums;

enum ArticleStatus: int
{
    case DRAFT = 1;
    case NEW = 5;
    case APPROVED = 10;
    case REJECTED = 15;

    public function getStatus(): string
    {
        return match ($this) {
            self::DRAFT => 'Черновик',
            self::NEW => 'Новая',
            self::APPROVED => 'Подтверждена',
            self::REJECTED => 'Отклонена',
        };
    }
}
