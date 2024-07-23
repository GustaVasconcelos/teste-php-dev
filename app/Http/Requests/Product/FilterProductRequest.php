<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class FilterProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'sub_category_id' => 'nullable|integer|exists:sub_categories,id',
            'user_id' => 'nullable|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'category_id.integer' => 'O ID da categoria deve ser um número inteiro.',
            'category_id.exists' => 'A categoria selecionada não existe.',
            'sub_category_id.integer' => 'O ID da subcategoria deve ser um número inteiro.',
            'sub_category_id.exists' => 'A subcategoria selecionada não existe.',
            'user_id.integer' => 'O ID do usuário deve ser um número inteiro.',
            'user_id.exists' => 'O usuário selecionado não existe.',
        ];
    }
}
