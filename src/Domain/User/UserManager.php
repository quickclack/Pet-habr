<?php

declare(strict_types=1);

namespace Domain\User;

use Carbon\Carbon;
use Domain\Interactive\NotificationManager;
use Domain\User\Models\User;
use Illuminate\Http\Request;

final class UserManager
{
    public function update(Request $request, User $user): void
    {
        $user->roles()->attach($request->get('role'));

        if ($request->boolean('banned')) {
            $user->banned()->create([
                'user_id' => $user->getKey(),
                'banned' => true,
                'banned_start' => Carbon::now(),
                'banned_end' => Carbon::now()->addDays(12)
            ]);

            NotificationManager::sendToUserBanned($user);

        } else {
            $user->banned()->delete();
        }
    }

    public function destroy(User $user): void
    {
        $user->roles()->sync([]);

        $user->delete();
    }
}
