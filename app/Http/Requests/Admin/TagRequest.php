<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:1',
                'max:20'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Название'
        ];
    }
}
