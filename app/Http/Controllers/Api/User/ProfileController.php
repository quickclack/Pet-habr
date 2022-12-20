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
use Support\Enums\ArticleStatus;
use Support\Traits\HasValidated;

class ProfileController extends Controller
{
    use HasValidated;

    public function __construct(
        protected ArticleBuilder $articleBuilder,
        protected UserBuilder $userBuilder,
    ){
    }

    public function updateProfile(ProfileRequest $request): JsonResponse
    {
        $user = $this->userBuilder->getUserById();

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
            $this->articleBuilder->getUserArticles()
        );
    }

    public function getArticleById(int $id): JsonResponse
    {
        $article = $this->articleBuilder->getArticleById($id);

        if (!$article) {
            return $this->missing('статьи');
        }

        return response()->json([
            'article' => new ArticleProfileResource($article)
        ]);
    }

    public function getAllAmountForUser(): JsonResponse
    {
        $user = $this->userBuilder->getUserById();

        return response()->json([
                'amount_articles' => $user->articles()
                    ->where('status', ArticleStatus::APPROVED)
                    ->count(),
                'amount_comments' => $user->comments()->count(),
            ]);
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

    public function getUserFavoriteArticles(): ArticleProfileCollection
    {
        return new ArticleProfileCollection(
            $this->articleBuilder->getUserFavoriteArticles()
        );
    }
    public function addToFavorites(int $id)
    {
        $user = $this->userBuilder->getUserById();
        $user->favoriteArticles()->syncWithoutDetaching($id);
        return response()->json(['message' => 'Статья добавлена в избранное']);
    }
    public function removeFromFavorites(int $id)
    {
        $user = $this->userBuilder->getUserById();
        $user->favoriteArticles()->detach($id);
        return response()->json(['message' => 'Статья убрана из избранного']);
    }
}
