<?php

declare(strict_types=1);

namespace Domain\Information;

use Domain\User\Models\User;
use Illuminate\Http\Request;

final class UserManager
{
    public function update(Request $request, User $user): void
    {
        $user->roles()->attach($request->get('role'));

        $user->is_banned = $request->boolean('banned');

        $user->save();
    }

    public function destroy(User $user): void
    {
        $user->roles()->sync([]);

        $user->delete();
    }
}
