<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ProfileRequest;
use Domain\Information\Models\Article;
use Domain\User\Actions\Contracts\UpdateProfileContract;
use Domain\User\DTO\UpdateProfileDto;
use Illuminate\Http\JsonResponse;
use Support\Traits\Validated;

class ProfileController extends Controller
{
    use Validated;

    public function updateProfile(ProfileRequest $request, UpdateProfileContract $contract, int $id): JsonResponse
    {
        $contract(UpdateProfileDto::formRequest($this->validated($request, 'avatar', 'avatars')), $id);

        return response()->json(['message' => 'Профиль успешно обновлен']);
    }

    public function createArticle(ArticleRequest $request, Article $article): JsonResponse
    {
        article()->store($request, $article);

        return response()->json(['message' => 'Статья отправлена на модерацию']);
    }
}
