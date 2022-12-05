<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\Api\Profile\Article\ArticleProfileCollection;
use Domain\Information\Queries\ArticleBuilder;
use Domain\User\Actions\Contracts\UpdateProfileContract;
use Domain\User\DTO\UpdateProfileDto;
use Illuminate\Http\JsonResponse;
use Support\Enums\ArticleStatus;
use Support\Traits\Validated;

class ProfileController extends Controller
{
    use Validated;

    public function __construct(
        protected ArticleBuilder $builder
    ){
    }

    public function updateProfile(ProfileRequest $request, UpdateProfileContract $contract, int $id): JsonResponse
    {
        $contract(UpdateProfileDto::formRequest(
            $this->validated($request, 'avatar', 'avatars')
        ), $id);

        return response()->json(['message' => 'Профиль успешно обновлен']);
    }

    public function createArticle(ArticleRequest $request): JsonResponse
    {
        article()->store($request);

        return response()->json(['message' => 'Статья отправлена на модерацию']);
    }

    public function getUserArticles(): ArticleProfileCollection
    {
        return new ArticleProfileCollection(
            $this->builder->getUserArticles()
        );
    }

    public function update(ArticleRequest $request, int $id): JsonResponse
    {
        $article = $this->builder->getArticleById($id);

        $this->authorize('update-article', $article);

        $article->status = ArticleStatus::NEW;

        $article->update($request->validated());

        return response()->json(['message' => 'Статья успешно обновлена и отправлена на модерацию']);
    }

    public function destroy(int $id): JsonResponse
    {
        $article = $this->builder->getArticleById($id);

        $this->authorize('delete-article', $article);

        $article->delete();

        return response()->json(['message' => 'Статья успешно удалена']);
    }
}
