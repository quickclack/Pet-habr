<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Domain\Information\Models\Category;
use Domain\Information\Queries\CategoryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(CategoryBuilder $builder): Application|Factory|View
    {
        return view('admin.category.index', [
            'categories' => $builder->getAllCategories()
        ]);
    }

    public function create(): Application|Factory|View
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->create($request->validated());

        flash()->success('Категория успешно добавлена');

        return to_route('admin.category.index');
    }

    public function edit(Category $category): Application|Factory|View
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        flash()->success('Изменения сохранены');

        return to_route('admin.category.index');
    }

    public function destroy(Category $category)
    {
        // TODO реализовать
    }
}
