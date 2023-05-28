<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Information\Models\Tag;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\TagRequest;
use Domain\Information\Queries\TagBuilder;
use App\View\ViewModels\Tag\TagEditViewModel;
use App\View\ViewModels\Tag\TagIndexViewModel;
use Illuminate\Contracts\View\View as ViewContract;

class TagController extends Controller
{
    public function __construct(
        protected readonly TagBuilder $builder
    ){
    }

    public function index(): TagIndexViewModel
    {
        return (new TagIndexViewModel($this->builder))
            ->view('admin.tag.index');
    }

    public function create(): ViewContract
    {
        return View::make('admin.tag.create');
    }

    public function store(TagRequest $request, Tag $tag): RedirectResponse
    {
        tag()->store(request: $request, tag: $tag);

        flash()->success('Тег успешно добавлена');

        return to_route('admin.tags.index');
    }

    public function edit(Tag $tag)
    {
        return (new TagEditViewModel($tag))
            ->view('admin.tag.edit');
    }

    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        tag()->update(request: $request, tag: $tag);

        flash()->success('Изменения сохранены');

        return to_route('admin.tags.index');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        tag()->destroy(tag: $tag);

        flash()->success('Тег успешно удален');

        return to_route('admin.tags.index');
    }
}
