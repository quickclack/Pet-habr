<?php

declare(strict_types=1);

namespace Domain\Information;

use App\Jobs\ArticleApprovalJob;
use Domain\Information\Models\Article;
use Domain\Information\Queries\ArticleBuilder;
use Domain\User\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Http\FormRequest;
use Support\Enums\ArticleStatus;
use Support\Traits\HasValidated;

final class ArticleManager
{
    use HasValidated, AuthorizesRequests;

    public function create(FormRequest $request): void
    {
        $article = Article::create(
            $this->validated($request, 'image', 'articles')
        );

        $article->status = ArticleStatus::DRAFT;

        $this->addUser($article); // костыльно

        $article->tags()->sync($request->tags);
    }

    public function store(FormRequest $request): void
    {
        $article = Article::create(
            $this->validated($request, 'image', 'articles')
        );

        $this->addUser($article); // костыльно

        $article->tags()->sync($request->tags);
    }

    public function update(FormRequest $request, Article $article): void
    {
        $article->update($this->validated($request, 'image', 'articles'));

        $article->tags()->sync($request->tags);
    }

    public function publish(Article $article): void
    {
        $article->status = ArticleStatus::NEW;

        $article->save();
    }

    public function updateInProfile(FormRequest $request, int $id): void
    {
        $article = Article::findOrFail($id);

        $this->authorize('update-article', $article);

        $article->update($this->validated($request, 'image', 'articles'));
    }

    public function destroy(Article $article): void
    {
        $article->tags()->sync([]);

        $article->delete();
    }

    public function destroyInProfile(int $id): void
    {
        $article = Article::findOrFail($id);

        $this->authorize('delete-article', $article);

        $article->delete();
    }

    public function approve(ArticleBuilder $builder, int $id): void
    {
        $article = $builder->getArticleById($id);

        $article->status = ArticleStatus::APPROVED;

        $article->save();

        dispatch(new ArticleApprovalJob(User::find($article->user_id)));
    }

    public function reject(ArticleBuilder $builder, int $id): void
    {
        $article = $builder->getArticleById($id);

        $article->status = ArticleStatus::REJECTED;

        $article->save();
    }

    public function withdraw(Article $article): void
    {
        $article->status = ArticleStatus::DRAFT;

        $article->save();
    }

    private function addUser(Article $article): void
    {
        $article->user_id = auth()->id();

        $article->update();
    }
}
