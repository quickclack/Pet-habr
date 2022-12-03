<?php

namespace Domain\User\DTO;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

final class NewCommentDto
{
    use Makeable;

    public function __construct(
        public readonly string $comment,
        public readonly int $article_id
    ){
    }

    public static function formRequest(Request $request): self
    {
        return self::make(...$request->only(['comment', 'article_id']));
    }
}
