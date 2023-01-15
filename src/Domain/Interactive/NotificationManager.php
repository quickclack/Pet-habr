<?php

declare(strict_types=1);

namespace Domain\Interactive;

use Domain\Information\Models\Article;
use Domain\Interactive\Models\Notification;
use Domain\User\Models\Comment;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Support\Enums\NotificationType;

final class NotificationManager
{
    public static function sendToModerator(Comment $comment): void
    {
        $users = User::query()
            ->whereRelation('roles', 'name', '=', 'Moderator')
            ->get();

        if (strpos($comment->comment, '@moderator') !== false) {
            $users->each(function ($user) use ($comment) {
                Notification::create([
                    'user_id' => $user->id,
                    'notification_type_id' => NotificationType::Services,
                    'message' => $comment->comment,
                    'article_id' => request('article_id') ?? self::getFields((int) request('parent_id')),
                    'comment_id' => request('parent_id')
                ]);
            });
        }
    }

    public static function sendToUserRejected(Article|Model $article): void
    {
        Notification::create([
            'user_id' => $article->user_id,
            'notification_type_id' => NotificationType::Systems,
            'message' => "Статья $article->title была отклонена"
        ]);
    }

    public static function sendToUserBanned(User $user): void
    {
        $bannedEnd = $user->banned->banned_end->format('d-m-Y');

        Notification::create([
            'user_id' => $user->getKey(),
            'notification_type_id' => NotificationType::Systems,
            'message' => "Ваш аккаунт заблокирован за нарушение, до $bannedEnd"
        ]);
    }

    private static function getFields(int $id): int
    {
        $comment = Comment::query()
            ->select('article_id')
            ->where('id', $id)
            ->first();

        return $comment->article_id;
    }
}
