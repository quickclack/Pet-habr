<?php

namespace Domain\User\Actions;

use Domain\User\Actions\Contracts\CreateCommentContract;
use Domain\User\DTO\NewCommentDto;
use Domain\User\Models\Comment;

class CreateCommentActions implements CreateCommentContract
{
    public function __invoke(NewCommentDto $data): Comment
    {
        $data->user_id = auth()->id();

        $comment = Comment::create([
            'comment' => $data->comment,
            'article_id' => $data->article_id,
            'user_id' => $data->user_id,
        ]);

        return $comment;
    }
}
