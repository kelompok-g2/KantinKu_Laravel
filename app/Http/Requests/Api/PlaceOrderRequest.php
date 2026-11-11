<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['idempotency_key' => $this->header('Idempotency-Key')]);
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1|max:50',
            'items.*' => 'required|array:menu_id,quantity',
            'items.*.menu_id' => 'required|integer|min:1|distinct',
            'items.*.quantity' => 'required|integer|min:1|max:20',
            'pickup' => 'required|in:asap,after_class,scheduled',
            'pickup_time' => 'exclude_unless:pickup,scheduled|required|date_format:H:i',
            'note' => 'nullable|string|max:300',
            'idempotency_key' => 'nullable|uuid',
        ];
    }
}
