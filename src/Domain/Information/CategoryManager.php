<?php

declare(strict_types=1);

namespace Domain\Information;

use Domain\Information\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

final class CategoryManager
{
    public function store(FormRequest $request, Category $category): void
    {
        $category->create($request->validated());
    }

    public function update(FormRequest $request, Category $category): void
    {
        $category->update($request->validated());
    }

    public function destroy(Category $category)
    {
        if (count($category->articles)) {
            flash()->message('Невозможно, у категории есть статьи');

            return to_route('admin.category.index');
        }

        $category->delete();
    }
}
