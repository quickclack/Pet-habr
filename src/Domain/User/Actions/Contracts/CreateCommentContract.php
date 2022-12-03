<?php

namespace Domain\User\Actions\Contracts;

use Domain\User\DTO\NewCommentDto;
use Domain\User\Models\Comment;

interface CreateCommentContract
{
    public function __invoke(NewCommentDto $data): Comment;
}
