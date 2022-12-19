<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\Api\Profile\Article\ArticleProfileCollection;
use App\Http\Resources\Api\Profile\Article\ArticleProfileResource;
use Domain\Information\Queries\ArticleBuilder;
use Domain\User\Queries\UserBuilder;
use Illuminate\Http\JsonResponse;
use Support\Traits\HasValidated;

class ProfileController extends Controller
{
    use HasValidated;

    public function __construct(
        protected ArticleBuilder $builder
    ){
    }

    public function updateProfile(ProfileRequest $request, UserBuilder $builder): JsonResponse
    {
        $user = $builder->getUserById();

        $user->update($this->validated($request, 'avatar', 'avatars'));

        return $this->updateSuccess('Профиль');
    }

    public function createArticle(ArticleRequest $request): JsonResponse
    {
        article()->store($request);

        return response()
            ->json(['message' => 'Статья отправлена на модерацию']);
    }

    public function getUserArticles(): ArticleProfileCollection
    {
        return new ArticleProfileCollection(
            $this->builder->getUserArticles()
        );
    }

    public function getArticleById(int $id): JsonResponse
    {
        $article = $this->builder->getArticleById($id);

        if (!$article) {
            return $this->missing('статьи');
        }

        return response()->json([
            'article' => new ArticleProfileResource($article)
        ]);
    }

    public function getCountUserArticles(): JsonResponse
    {
        return response()
            ->json(['count' => $this->builder->getCountUserArticles()]);
    }

    public function update(ArticleRequest $request, int $id): JsonResponse
    {
        article()->updateInProfile($request, $id);

        return response()
            ->json(['message' => 'Статья успешно обновлена и отправлена на модерацию']);
    }

    public function destroy(int $id): JsonResponse
    {
        article()->destroyInProfile($id);

        return $this->deleteSuccess('Статья');
    }
}
