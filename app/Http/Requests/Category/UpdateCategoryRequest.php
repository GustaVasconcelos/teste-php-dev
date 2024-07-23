<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->route('id'),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da categoria é obrigatório.',
            'name.unique' => 'O nome da categoria já está em uso.',
        ];
    }
}
