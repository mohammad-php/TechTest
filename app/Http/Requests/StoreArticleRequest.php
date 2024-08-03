<?php

namespace App\Http\Requests;

use http\Client\Request;
use Illuminate\Foundation\Http\FormRequest;

/**
 *
 * @param Request $request
 *
 * @return ${RETURN_TYPE}
 */
class StoreArticleRequest extends FormRequest
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
                'required',
                'string',
                'max:255',
                'unique:articles,title',
            ],
            'content' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * @return array
     */
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
            'image' => [
                'nullable',
                'file',
                'image',
                'max:2048',
            ],
        ];
    }
}
