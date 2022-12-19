<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domain\Information\Models\Article;
use Domain\User\Models\Comment;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    public function toggleArticle(Article $article): JsonResponse
    {
        $article->likes()->toggle(auth('sanctum')->id());

        return $this->addSuccess('Лайк');
    }

    public function toggleComment(Comment $comment): JsonResponse
    {
        $comment->likes()->toggle(auth('sanctum')->id());

        return $this->addSuccess('Лайк');
    }
}
