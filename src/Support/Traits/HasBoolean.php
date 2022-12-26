<?php

namespace Support\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasBoolean
{
    public function getBoolean(BelongsToMany $toMany): bool
    {
        $entity = $toMany->where('user_id', auth('sanctum')->id())->first();

        $boolean = auth('sanctum')->check()
            && !empty($entity->pivot->user_id) == auth('sanctum')->id() ? true : false;

        return $boolean;
    }
}
