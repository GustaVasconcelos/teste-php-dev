<?php

namespace App\Http\Controllers\SubCategory;

use App\Exceptions\ItemNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Services\Category\CategoryService;
use App\Services\SubCategory\SubCategoryService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller 
{

    public function __construct
    (
        protected SubCategoryService $subCategoryService,
        protected CategoryService $categoryService
    )
    {}

    public function index(int $categoryId, Request $request): View|RedirectResponse
    {
        try {
            $name = $request->input('name');
            $subCategories = $this->subCategoryService->getAllWithFilter($categoryId, $name);
            
            return view('pages.categories.subcategories.index', compact('subCategories', 'categoryId'));
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Erro ao mostrar a página de sub categorias' . $e->getMessage() );
        }
    }

    public function create(int $categoryId): View|RedirectResponse
    {
        try {            
            return view('pages.categories.subcategories.create', compact('categoryId'));
        } catch (Exception $e) {
            return redirect()->route('categories.subcategories.index', $categoryId)->with('error', 'Erro ao mostrar página de cadastrar sub categorias', $e->getMessage());
        }
    }

    public function store(int $categoryId, StoreSubCategoryRequest $request): RedirectResponse
    {
        try {
            $this->subCategoryService->create($categoryId, $request->validated());

            return redirect()->route('categories.subcategories.create', $categoryId)->with('success', 'Sub categoria criada com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.subcategories.create', $categoryId)->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.subcategories.create', $categoryId)->with('error', 'Erro ao cadastrar sub categoria');
        }
    }

    public function edit(int $categoryId, int $id): View|RedirectResponse
    {
        try {
            $subCategory = $this->subCategoryService->getById($id);

            return View('pages.categories.subcategories.edit', compact('subCategory', 'categoryId'));
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.subcategories.index', $categoryId)->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.subcategories.index', $categoryId)->with('error', 'Erro ao mostrar página de editar sub categoria');
        }
    }

    public function update(int $categoryId, int $id, UpdateSubCategoryRequest $request): RedirectResponse
    {
        try {
            $this->subCategoryService->update($id, $request->validated());

            return redirect()->route('categories.subcategories.edit', [$categoryId,$id])->with('success', 'Sub categoria editada com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.subcategories.edit', [$categoryId,$id])->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.subcategories.edit', [$categoryId,$id])->with('error', 'Erro ao editar sub categoria');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            $this->subCategoryService->delete($request->id);

            return redirect()->route('categories.subcategories.index', $request->categoryId)->with('success', 'Sub categoria deletada com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.subcategories.index', $request->categoryId)->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.subcategories.index', $request->categoryId)->with('error', 'Erro ao deletar sub categoria');
        }
    }
}
