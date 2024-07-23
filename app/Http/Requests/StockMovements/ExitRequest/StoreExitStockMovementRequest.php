<?php

namespace App\Http\Requests\StockMovements\ExitRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreExitStockMovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id|integer',
            'quantity' => 'required|integer|min:1',
            'control_number' => 'required|string|max:255|unique:stock_movements_exits,control_number',
            'destination' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'O ID do produto é obrigatório.',
            'product_id.exists' => 'O ID do produto deve corresponder a um produto existente.',
            'product_id.integer' => 'O ID do produto deve ser um número inteiro.',
            'quantity.required' => 'A quantidade é obrigatória.',
            'quantity.integer' => 'A quantidade deve ser um número inteiro.',
            'quantity.min' => 'A quantidade mínima é 1.',
            'control_number.required' => 'O número de controle é obrigatório.',
            'control_number.unique' => 'O número de controle já está em uso.',
            'destination.required' => 'O destino é obrigatório.',
        ];
    }
}
