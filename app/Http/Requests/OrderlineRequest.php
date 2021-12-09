<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class OrderlineRequest extends FormRequest
{
    #[ArrayShape(['order_id' => "string", 'status' => "string", 'price_unit' => "string", 'quantity' => "string"])] public function rules(): array {
        return [
            'order_id' => 'sometimes|required|exists:orders,id',
            'status' => 'sometimes|required|between:1,19',
            'price_unit' => 'sometimes|required|numeric|min:0.01',
            'quantity' => 'sometimes|required|numeric|min:1'
        ];
    }

    public function authorize(): bool {
        return true;
    }
}
