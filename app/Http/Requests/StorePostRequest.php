<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3',
            'body' => 'required|string|min:2',
            //'tags' => 'array',
            //'tags.*' => 'string|min:2' 
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title MUST BE a valid string!',
            'title.min' => 'Title length must be at least :min'
        ];
    }
}
