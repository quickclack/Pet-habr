<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use Domain\Information\Models\Article;
use Domain\User\Models\Comment;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    protected const FOR_MODELS = [
        'article' => Article::class,
        'comment' => Comment::class,
    ];

    public function __invoke(LikeRequest $request): JsonResponse
    {
        like()->set(self::FOR_MODELS[$request->type], $request->id);

        return response()->json(['message' => 'Успешно']);
    }
}
