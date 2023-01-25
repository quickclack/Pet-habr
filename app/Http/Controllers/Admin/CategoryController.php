<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\View\ViewModels\Category\CategoryEditViewModel;
use App\View\ViewModels\Category\CategoryIndexViewModel;
use Domain\Information\Models\Category;
use Domain\Information\Queries\CategoryBuilder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct(
        protected readonly CategoryBuilder $builder
    ){
    }

    public function index(): CategoryIndexViewModel
    {
        return (new CategoryIndexViewModel($this->builder))
            ->view('admin.category.index');
    }

    public function create(): Application|Factory|View
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request, Category $category): RedirectResponse
    {
        category()->store(request: $request, category: $category);

        flash()->success('Категория успешно добавлена');

        return to_route('admin.category.index');
    }

    public function edit(Category $category): CategoryEditViewModel
    {
        return (new CategoryEditViewModel($category))
            ->view('admin.category.edit');
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        category()->update(request: $request, category: $category);

        flash()->success('Изменения сохранены');

        return to_route('admin.category.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        category()->destroy(category: $category);

        flash()->success('Категория успешно удалена');

        return to_route('admin.category.index');
    }
}
