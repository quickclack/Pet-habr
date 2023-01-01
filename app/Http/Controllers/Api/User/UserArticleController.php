<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\Api\Profile\Article\ArticleProfileCollection;
use App\Http\Resources\Api\Profile\Article\ArticleProfileResource;
use Domain\Information\Models\Article;
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
        article()->create($request);

        return $this->message('Статья сохранена в черновик');
    }

    public function publish(Article $article): JsonResponse
    {
        article()->publish($article);

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

    public function withdraw(Article $article): JsonResponse
    {
        if ($article->status == ArticleStatus::NEW) {
            throw new \Exception('Невозможно снять статью которая на модерации');
        }

        article()->withdraw($article);

        return $this->message('Статья снята с публикации и сохранена в черновик');
    }
}
