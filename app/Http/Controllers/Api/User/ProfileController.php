<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ProfileRequest;
use Domain\Information\Models\Article;
use Domain\User\Actions\Contracts\UpdateProfileContract;
use Domain\User\DTO\UpdateProfileDto;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function updateProfile(
        ProfileRequest $request, UpdateProfileContract $contract, int $id
    ): JsonResponse
    {
        $contract(UpdateProfileDto::formRequest($request), $id);

        return response()->json(['message' => 'Профиль успешно обновлен']);
    }

    public function createArticle(ArticleRequest $request): JsonResponse
    {
        $article = Article::create($request->validated());

        $article->user_id = auth()->id() ?? null;

        $article->tags()->sync($request->tags);

        return response()->json(['message' => 'Статья отправлена на модерацию']);
    }
}
