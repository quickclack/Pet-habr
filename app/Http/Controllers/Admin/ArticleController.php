<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\View\ViewModels\Article\ArticleCreateViewModel;
use App\View\ViewModels\Article\ArticleEditViewModel;
use App\View\ViewModels\Article\ArticleIndexViewModel;
use App\View\ViewModels\Article\ArticleShowViewModel;
use Domain\Information\Models\Article;
use Domain\Information\Queries\ArticleBuilder;
use Domain\Information\Queries\CategoryBuilder;
use Domain\Information\Queries\TagBuilder;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleBuilder $articleBuilder,
        protected CategoryBuilder $categoryBuilder,
        protected TagBuilder $tagBuilder
    ){
    }

    public function index(): ArticleIndexViewModel
    {
        return (new ArticleIndexViewModel($this->articleBuilder))
            ->view('admin.article.index');
    }

    public function show(): ArticleShowViewModel
    {
        return (new ArticleShowViewModel($this->articleBuilder))
            ->view('admin.article.new');
    }

    public function create(): ArticleCreateViewModel
    {
        return (new ArticleCreateViewModel($this->categoryBuilder, $this->tagBuilder))
            ->view('admin.article.create');
    }

    public function store(ArticleRequest $request, Article $article): RedirectResponse
    {
        article()->store($request, $article);

        flash()->success('Статья отправлена на модерацию');

        return to_route('admin.articles.index');
    }

    public function edit(Article $article): ArticleEditViewModel
    {
        return (new ArticleEditViewModel($article, $this->categoryBuilder, $this->tagBuilder))
            ->view('admin.article.edit');
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        article()->update($request, $article);

        flash()->success('Статья успешно обновлена');

        return to_route('admin.articles.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
        article()->destroy($article);

        flash()->success('Статья успешно удалена');

        return to_route('admin.articles.index');
    }

    public function approve(int $id): RedirectResponse
    {
        article()->approve($this->articleBuilder, $id);

        flash()->success('Статья подтверждена');

        return back();
    }

    public function reject(int $id): RedirectResponse
    {
        article()->reject($this->articleBuilder, $id);

        flash()->success('Статья отклонена');

        return back();
    }
}
