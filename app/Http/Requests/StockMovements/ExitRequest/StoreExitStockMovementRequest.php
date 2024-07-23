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
            'entries.*.product_id' => 'required|exists:products,id|integer',
            'entries.*.quantity' => 'required|integer|min:1',
            'entries.*.control_number' => 'required|string|max:255|unique:stock_movements_exits,control_number',
            'entries.*.destination' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'entries.*.product_id.required' => 'O ID do produto é obrigatório para cada entrada.',
            'entries.*.product_id.exists' => 'O ID do produto deve corresponder a um produto existente para cada entrada.',
            'entries.*.product_id.integer' => 'O ID do produto deve ser um número inteiro para cada entrada.',
            'entries.*.quantity.required' => 'A quantidade é obrigatória para cada entrada.',
            'entries.*.quantity.integer' => 'A quantidade deve ser um número inteiro para cada entrada.',
            'entries.*.quantity.min' => 'A quantidade mínima é 1 para cada entrada.',
            'entries.*.control_number.required' => 'O número de controle é obrigatório para cada entrada.',
            'entries.*.control_number.unique' => 'O número de controle já está em uso para uma das entradas.',
            'entries.*.destination.required' => 'O destino é obrigatório para cada entrada.',
        ];
    }
}
