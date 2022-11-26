<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category_id' => [
                'required',
                'min:1',
                'integer',
                'exists:categories,id'
            ],
            'image' => [
                'image',
                'nullable',
                'max:1999',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
        ];
    }
}
