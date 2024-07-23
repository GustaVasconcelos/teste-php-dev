<?php

namespace App\Http\Requests\StockMovements;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStockMovementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'type' => ['required', Rule::in(['entry', 'exit'])],
            'invoice_number' => 'required_if:type,entry|nullable|string|max:255',
            'supplier' => 'required_if:type,entry|nullable|string|max:255',
            'control_number' => 'required_if:type,exit|nullable|string|max:255|unique:stock_movements,control_number',
            'destination' => 'required_if:type,exit|nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'A quantidade é obrigatória.',
            'quantity.integer' => 'A quantidade deve ser um número inteiro.',
            'quantity.min' => 'A quantidade mínima é 1.',
            'date.required' => 'A data é obrigatória.',
            'date.date' => 'A data deve ser uma data válida.',
            'type.required' => 'O tipo de movimentação é obrigatório.',
            'type.in' => 'O tipo de movimentação deve ser "entry" ou "exit".',
            'invoice_number.required_if' => 'O número da nota fiscal é obrigatório para entradas.',
            'supplier.required_if' => 'O fornecedor é obrigatório para entradas.',
            'control_number.required_if' => 'O número de controle é obrigatório para saídas.',
            'control_number.unique' => 'O número de controle já está em uso.',
            'destination.required_if' => 'O destino é obrigatório para saídas.',
        ];
    }
}
