<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('articles', 'title')
                    ->ignore($this->id),
            ],
            'content' => [
                'sometimes',
                'string',
            ],
            'image' => [
                'nullable',
                'file',
                'image',
                'max:2048',
            ],
        ];
    }

    public function bodyParameters()
    {
        return [
            'title' => [
                'description' => 'The title of the article.',
            ],
            'content' => [
                'description' => 'Contents of the article.',
                'example' => 'My First Article',
            ],
        ];
    }
}
