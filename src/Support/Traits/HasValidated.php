<?php

namespace Support\Traits;

use Illuminate\Foundation\Http\FormRequest;

trait HasValidated
{
    public function validated(FormRequest $request, string $key, string $directory): mixed
    {
        $validated = $request->validated();

        if ($request->hasFile($key)) {
            $validated[$key] = upload()->uploadImage($request->file($key), $directory);
        }

        return $validated;
    }
}
