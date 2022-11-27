<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Domain\Information\Models\Article;
use Domain\Information\Queries\ArticleBuilder;
use Domain\Information\Queries\CategoryBuilder;
use Domain\Information\Queries\TagBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Support\Enums\ArticleStatus;

class ArticleController extends Controller
{
    public function index(ArticleBuilder $builder): Application|Factory|View
    {
        return view('admin.article.index', [
            'countNewArticle' => $builder->getCountNewArticles(),
            'articles' => $builder->getArticlesWithPaginate(ArticleStatus::APPROVED)
        ]);
    }

    public function show(ArticleBuilder $builder): Application|Factory|View
    {
        return view('admin.article.new', [
            'articles' => $builder->getArticlesWithPaginate(ArticleStatus::NEW)
        ]);
    }

    public function create(CategoryBuilder $builder, TagBuilder $tagBuilder): Application|Factory|View
    {
        return view('admin.article.create', [
            'categories' => $builder->getCategoryByPlug(),
            'tags' => $tagBuilder->getTagByPluck()
        ]);
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = upload()
                ->uploadImage($request->file('image'), 'articles');
        }

        $article = Article::create($validated);

        $article->user_id = auth()->id() ?? null;

        $article->tags()->sync($request->tags);

        flash()->success('Статья отправлена на модерацию');

        return to_route('admin.articles.index');
    }

    public function edit(Article $article, CategoryBuilder $builder, TagBuilder $tagBuilder): Application|Factory|View
    {
        return view('admin.article.edit', [
            'article' => $article,
            'categories' => $builder->getCategoryByPlug(),
            'tags' => $tagBuilder->getTagByPluck()
        ]);
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = upload()
                ->uploadImage($request->file('image'), 'articles');
        }

        $article->update($validated);

        $article->tags()->sync($request->tags);

        flash()->success('Статья успешно обновлена');

        return to_route('admin.articles.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->tags()->sync([]);

        $article->delete();

        flash()->success('Статья успешно удалена');

        return to_route('admin.articles.index');
    }

    public function approve(ArticleBuilder $builder, int $id): RedirectResponse
    {
        $article = $builder->getArticleById($id);

        $article->status = ArticleStatus::APPROVED;

        $article->save();

        flash()->success('Статья подтверждена');

        return back();
    }

    public function reject(ArticleBuilder $builder, int $id): RedirectResponse
    {
        $article = $builder->getArticleById($id);

        $article->status = ArticleStatus::REJECTED;

        $article->save();

        flash()->success('Статья отклонена');

        return back();
    }
}
