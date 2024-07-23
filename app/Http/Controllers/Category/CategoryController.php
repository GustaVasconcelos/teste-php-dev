<?php

namespace App\Http\Controllers\Category;

use App\Exceptions\ItemNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller 
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request): View|RedirectResponse
    {
        try {
            $name = $request->input('name');
            $categories = $this->categoryService->getAllWithFilter($name);

            return view('pages.categories.index', compact('categories'));
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('error', 'Erro ao mostrar a página de categorias!');
        }
    }

    public function create(): View|RedirectResponse
    {
        try {
            return view('pages.categories.create');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Erro ao mostrar página de cadastrar categorias');
        }
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        try {
            $this->categoryService->create($request->validated());

            return redirect()->route('categories.create')->with('success', 'Categoria criada com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.create')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.login')->with('error', 'Erro ao cadastrar categoria');
        }
    }

    public function edit(int $id): View|RedirectResponse
    {
        try {
            $category = $this->categoryService->getById($id);

            return View('pages.categories.edit', compact('category'));
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Erro ao mostrar página de editar categoria');
        }
    }

    public function update(int $id, UpdateCategoryRequest $request): RedirectResponse
    {
        try {
            $this->categoryService->update($id, $request->validated());

            return redirect()->route('categories.edit', $id)->with('success', 'Categoria editada com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.edit', $id)->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.edit', $id)->with('error', 'Erro ao editar categoria');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            $this->categoryService->delete($request->id);

            return redirect()->route('categories.index')->with('success', 'Categoria deletada com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('categories.delete')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('categories.delete')->with('error', 'Erro ao deletar categoria');
        }
    }
}
