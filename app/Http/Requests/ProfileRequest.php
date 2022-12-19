<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:10', 'min:1'],
            'lastName' => ['string', 'max:15', 'min:1'],
            'password' => [Password::default()],
            'description' => ['string', 'max:50', 'min:1'],
            'sex' => ['string'],
            'avatar' => [
                'nullable',
                'image',
                'max:1999',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'firstName' => 'Имя',
            'lastName' => 'Фамилия',
            'description' => 'Описание',
            'sex' => 'Пол',
            'avatar' => 'Аватар',
        ];
    }
}
