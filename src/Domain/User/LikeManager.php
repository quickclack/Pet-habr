<?php

declare(strict_types=1);

namespace Domain\User;

use Domain\User\Queries\LikeBuilder;

final class LikeManager
{
    public function __construct(
        protected LikeBuilder $builder
    ){
    }

    public function set(string $key, int $id): void
    {
        $model = $key::findOrFail($id);

        $like = !$model->likes()->exists()
            ? $model->likes()->create()
            : $this->builder->getLike($id);

        $like->quantity += 1;

        $like->save();
    }
}
