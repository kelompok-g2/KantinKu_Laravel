<?php

namespace App\Http\Requests\Api;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return ['status' => ['required', Rule::in(array_values(Order::NEXT))]];
    }
}
