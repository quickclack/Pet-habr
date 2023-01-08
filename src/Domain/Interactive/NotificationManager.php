<?php

declare(strict_types=1);

namespace Domain\Interactive;

use Domain\Information\Models\Article;
use Domain\Interactive\Models\Notification;
use Domain\User\Models\Comment;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;

final class NotificationManager
{
    public static function sendToModerator(Comment $comment): void
    {
        $users = User::query()
            ->whereRelation('roles', 'name', '=', 'Moderator')
            ->get();

        if (strpos($comment->comment, '@moderator') !== false) {
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'message' => $comment->comment
                ]);
            }
        }
    }

    public static function sendToUserRejected(Article|Model $article): void
    {
        Notification::create([
            'user_id' => $article->user_id,
            'message' => "Статья $article->title была отклонена"
        ]);
    }
}
