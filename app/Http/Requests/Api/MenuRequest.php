<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function rules(): array
    {
        $presence = $this->isMethod('PATCH') ? 'sometimes|required' : 'required';

        return [
            'name' => $presence.'|string|max:255',
            'category_id' => $presence.'|integer|exists:categories,id',
            'price' => $presence.'|numeric|decimal:0,2|min:0|max:9999999999.99',
            'stand' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image_url' => 'nullable|url:http,https|max:255',
            'is_available' => 'sometimes|boolean',
        ];
    }
}
