<?php

namespace App\Http\Requests\Product;

use App\Repositories\SubCategory\SubCategoryRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{

    public function __construct
    (
        protected SubCategoryRepository $subCategoryRepository
    )
    {}

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')
            ],
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => [
                'required',
                'exists:sub_categories,id',
                function ($attribute, $value, $fail) {
                    $categoryId = $this->input('category_id');
                    if (!$this->subCategoryRepository->belongsToCategory($value, $categoryId)) {
                        $fail('A subcategoria selecionada não pertence à categoria selecionada.');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'name.unique' => 'O nome do produto já está em uso.',
            'description.required' => 'A descrição do produto é obrigatória.',
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria selecionada não existe.',
            'sub_category_id.required' => 'A subcategoria é obrigatória.',
            'sub_category_id.exists' => 'A subcategoria selecionada não existe.',
        ];
    }
}
