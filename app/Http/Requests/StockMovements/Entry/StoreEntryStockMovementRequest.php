<?php

namespace App\Http\Requests\StockMovements\Entry;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntryStockMovementRequest extends FormRequest
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
            'invoice_number' => 'required|string|max:255',
            'supplier' => 'required|string|max:255',
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
            'invoice_number.required' => 'O número da nota fiscal é obrigatório.',
            'invoice_number.string' => 'O número da nota fiscal deve ser uma string.',
            'invoice_number.max' => 'O número da nota fiscal não pode ter mais de 255 caracteres.',
            'supplier.required' => 'O fornecedor é obrigatório.',
            'supplier.string' => 'O fornecedor deve ser uma string.',
            'supplier.max' => 'O fornecedor não pode ter mais de 255 caracteres.',
        ];
    }
}
