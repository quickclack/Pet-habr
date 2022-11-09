<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use Domain\Information\Models\Article;
use Domain\Information\Queries\ArticleBuilder;
use Domain\Information\Queries\CategoryBuilder;
use Domain\User\Queries\UserBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index(ArticleBuilder $builder): Application|Factory|View
    {
        return view('admin.article.index', [
            'countNewArticle' => $builder->getCountNewArticles(),
            'articles' => $builder->getArticlesWithPaginate()
        ]);
    }

    public function show(ArticleBuilder $builder): Application|Factory|View
    {
        return view('admin.article.new', [
            'articles' => $builder->getAllNewArticles()
        ]);
    }

    public function create(CategoryBuilder $builder): Application|Factory|View
    {
        return view('admin.article.create', [
            'categories' => $builder->getCategoryByPlug()
        ]);
    }

    public function store(ArticleRequest $request, UserBuilder $builder): RedirectResponse
    {
        $user = $builder->getUserById(auth()->id());

        $user->articles()->create($request->validated());

        flash()->success('Статья успешно добавлена');

        return to_route('admin.articles.index');
    }

    public function edit(Article $article, CategoryBuilder $builder): Application|Factory|View
    {
        return view('admin.article.edit', [
            'article' => $article,
            'categories' => $builder->getCategoryByPlug()
        ]);
    }

    public function update(ArticleRequest $request)
    {
        // TODO реализовать
    }

    public function destroy()
    {
        // TODO реализовать
    }

    public function approve()
    {
        // TODO реализовать
    }

    public function reject()
    {
        // TODO реализовать
    }
}
