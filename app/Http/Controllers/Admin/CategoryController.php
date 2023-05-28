<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Domain\Information\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use Domain\Information\Queries\CategoryBuilder;
use Illuminate\Contracts\View\View as ViewContract;
use App\View\ViewModels\Category\CategoryEditViewModel;
use App\View\ViewModels\Category\CategoryIndexViewModel;

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

    public function create(): ViewContract
    {
        return View::make('admin.category.create');
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
