<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'quantity' => 'numeric|min:0',
            'unit_price' => 'numeric|min:0',
            'total_value' => 'numeric|min:0',
            'product_id' => 'exists:products,id',
            'warehouse_id' => 'exists:warehouses,id',
            'expires_at' => 'nullable|date|after_or_equal:today',
        ];
    }
}
