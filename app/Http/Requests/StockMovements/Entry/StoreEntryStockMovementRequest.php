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
            'entries' => 'required|array',
            'entries.*.product_id' => 'required|exists:products,id|integer',
            'entries.*.quantity' => 'required|integer|min:1',
            'entries.*.invoice_number' => 'required|string|max:255',
            'entries.*.supplier' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'entries.required' => 'O array de entradas é obrigatório.',
            'entries.array' => 'O array de entradas deve ser um array.',
            'entries.*.product_id.required' => 'O ID do produto é obrigatório.',
            'entries.*.product_id.exists' => 'O ID do produto deve corresponder a um produto existente.',
            'entries.*.product_id.integer' => 'O ID do produto deve ser um número inteiro.',
            'entries.*.quantity.required' => 'A quantidade é obrigatória.',
            'entries.*.quantity.integer' => 'A quantidade deve ser um número inteiro.',
            'entries.*.quantity.min' => 'A quantidade mínima é 1.',
            'entries.*.invoice_number.required' => 'O número da nota fiscal é obrigatório.',
            'entries.*.invoice_number.string' => 'O número da nota fiscal deve ser uma string.',
            'entries.*.invoice_number.max' => 'O número da nota fiscal não pode ter mais de 255 caracteres.',
            'entries.*.supplier.required' => 'O fornecedor é obrigatório.',
            'entries.*.supplier.string' => 'O fornecedor deve ser uma string.',
            'entries.*.supplier.max' => 'O fornecedor não pode ter mais de 255 caracteres.',
        ];
    }
}
