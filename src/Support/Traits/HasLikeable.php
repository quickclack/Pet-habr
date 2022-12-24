<?php

namespace Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasLikeable
{
    public function getBoolean(BelongsToMany $toMany): bool
    {
        $likes = $toMany->where('user_id', auth('sanctum')->id())->first();

        $liked = auth('sanctum')->check()
            && !empty($likes->pivot->user_id) == auth('sanctum')->id() ? true : false;

        return $liked;
    }
}
