<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [$this->isMethod('PATCH') ? 'sometimes' : 'bail', 'required', 'string', 'max:255', Rule::unique('categories')->ignore($this->route('category'))],
            'description' => 'nullable|string|max:1000',
        ];
    }
}
