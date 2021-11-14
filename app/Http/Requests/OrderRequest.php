<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array {
        return [
            'status' => 'sometimes|required|numeric|between:1,19',
            'order_ref' => 'sometimes|required|unique:orders,order_ref'
        ];
    }

    public function authorize(): bool {
        return true;
    }
}
