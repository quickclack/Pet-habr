<?php

namespace Domain\Interactive\Queries;

use App\Contracts\QueryBuilder;
use Domain\Interactive\Models\Like;
use Illuminate\Database\Eloquent\Builder;

class LikeBuilder implements QueryBuilder
{
    public function getBuilder(): Builder
    {
        return Like::query();
    }

    public function getLike(int $id, string $type): Like
    {
        return $this->getBuilder()
            ->where('likeable_id', $id)
            ->where('likeable_type', $type)
            ->firstOr(fn() => response()->json(['message' => 'Не найдено']));
    }
}
