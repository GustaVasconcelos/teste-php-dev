<?php

namespace App\Http\Requests\SubCategory;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\SubCategory\SubCategoryRepository;

class UpdateSubCategoryRequest extends FormRequest
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
                function ($attribute, $value, $fail) {
                    $categoryId = $this->route('categoryId');
                    $subCategoryId = $this->route('id');

                    if (!$this->subCategoryRepository->isUniqueInCategory($value, $categoryId, $subCategoryId)) {
                        $fail('O nome da subcategoria já está em uso nesta categoria.');
                    }
                },
            ],
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da subcategoria é obrigatório.',
            'name.max' => 'O nome da subcategoria não pode exceder 255 caracteres.',
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria selecionada não existe.',
        ];
    }
}
