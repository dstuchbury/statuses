<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class OrderRequest extends FormRequest
{
    #[ArrayShape(['status' => "string", 'order_ref' => "string"])] public function rules(): array {
        return [
            'status' => 'sometimes|required|numeric|between:1,19',
            'order_ref' => 'sometimes|required|unique:orders,order_ref'
        ];
    }

    public function authorize(): bool {
        return true;
    }
}
