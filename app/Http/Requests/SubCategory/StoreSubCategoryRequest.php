<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:sub_categories,name,NULL,id,category_id,' . $this->route('id'),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da subcategoria é obrigatório.',
            'name.unique' => 'O nome da subcategoria já está em uso nesta categoria.',
            'name.max' => 'O nome da subcategoria não pode exceder 255 caracteres.',
        ];
    }
}
