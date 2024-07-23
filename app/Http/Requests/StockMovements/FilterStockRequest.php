<?php

namespace App\Http\Requests\StockMovements;

use Illuminate\Foundation\Http\FormRequest;

class FilterStockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'productName' => 'nullable|string|max:255',
            'date' => 'nullable|date_format:Y-m-d', 
        ];
    }

    public function messages()
    {
        return [
            'productName.string' => 'O nome do produto deve ser uma string.',
            'productName.max' => 'O nome do produto não pode ter mais de 255 caracteres.',
            'date.date_format' => 'A data deve estar no formato YYYY-MM-DD.',
        ];
    }
}
