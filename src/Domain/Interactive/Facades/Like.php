<?php

namespace Domain\Interactive\Facades;

use Domain\Interactive\LikeManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static set(int $id, string $type)
 *
 * @see LikeManager
 */
final class Like extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LikeManager::class;
    }
}
