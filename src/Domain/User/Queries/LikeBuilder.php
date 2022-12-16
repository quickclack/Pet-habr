<?php

namespace Domain\User\Queries;

use App\Contracts\QueryBuilder;
use Domain\User\Models\Like;
use Illuminate\Database\Eloquent\Builder;

class LikeBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Like::query();
    }

    public function getLike(int $id): Like
    {
        return $this->getBuilder()
            ->where('likeable_id', $id)
            ->firstOr(fn() => response()->json(['message' => 'Не найдено']));
    }
}
