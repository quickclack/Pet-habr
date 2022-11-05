<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ArticleStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use Domain\Category\Queries\CategoryBuilder;
use Domain\User\Queries\UserBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticleController extends Controller
{
    public function index(): Application|Factory|View
    {
        // TODO вынести в query builder
        $countNewArticle = Article::where('status', ArticleStatus::NEW)->count();
        $articles = Article::where('status', ArticleStatus::APPROVED)->paginate(20);

        return view('admin.article.index', compact('countNewArticle', 'articles'));
    }

    public function show(): Application|Factory|View
    {
        // TODO вынести в query builder
        $articles = Article::where('status', ArticleStatus::NEW)->paginate(20);

        return view('admin.article.new', [
            'articles' => $articles
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
