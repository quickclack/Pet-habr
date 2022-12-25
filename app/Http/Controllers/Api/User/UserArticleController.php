<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\Api\Profile\Article\ArticleProfileCollection;
use App\Http\Resources\Api\Profile\Article\ArticleProfileResource;
use Domain\Information\Queries\ArticleBuilder;
use Domain\User\Queries\UserBuilder;
use Illuminate\Http\JsonResponse;
use Support\Enums\ArticleStatus;

class UserArticleController extends Controller
{
    public function __construct(
        protected ArticleBuilder $articleBuilder,
        protected UserBuilder $userBuilder,
    ){
    }

    public function getAll(): ArticleProfileCollection
    {
        return new ArticleProfileCollection(
            $this->articleBuilder->getUserArticles()
        );
    }

    public function getById(int $id): JsonResponse
    {
        $article = $this->articleBuilder->getArticleById($id);

        if (!$article) {
            return $this->missing('статьи');
        }

        return response()->json([
            'article' => new ArticleProfileResource($article)
        ]);
    }

    public function getAmount(): JsonResponse
    {
        $user = $this->userBuilder->getUserById();

        return response()->json([
            'amount_articles' => $user->articles()
                ->where('status', ArticleStatus::APPROVED)
                ->count(),
            'amount_comments' => $user->comments()->count(),
            'amount_bookmarks' => $user->bookmarks()->count(),
        ]);
    }

    public function create(ArticleRequest $request): JsonResponse
    {
        article()->store($request);

        return $this->message('Статья отправлена на модерацию');
    }

    public function update(ArticleRequest $request, int $id): JsonResponse
    {
        article()->updateInProfile($request, $id);

        return $this->message('Статья успешно обновлена и отправлена на модерацию');
    }

    public function destroy(int $id): JsonResponse
    {
        article()->destroyInProfile($id);

        return $this->deleteSuccess('Статья');
    }
}
