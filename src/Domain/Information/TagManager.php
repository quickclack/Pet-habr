<?php

declare(strict_types=1);

namespace Domain\Information;

use Domain\Information\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

final class TagManager
{
    public function store(FormRequest $request, Tag $tag): void
    {
        $tag->create($request->validated());
    }

    public function update(FormRequest $request, Tag $tag): void
    {
        $tag->update($request->validated());
    }

    public function destroy(Tag $tag): void
    {
        $tag->delete();
    }
}
