<?php

namespace App\Http\Requests;

use Domain\User\Rules\CommentRule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'comment' => [
                'required',
                'string',
                'max:100',
                new CommentRule()
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'comment' => 'Комментарий'
        ];
    }
}
