<?php

namespace App\Http\Controllers\Product;

use App\Exceptions\ItemNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\FilterProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\Category\CategoryService;
use App\Services\Product\ProductService;
use App\Services\SubCategory\SubCategoryService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller 
{

    public function __construct
    (
        protected ProductService $productService,
        protected CategoryService $categoryService,
        protected SubCategoryService $subCategoryService
    )
    {}

    public function index(FilterProductRequest $request): View|RedirectResponse
    {
        try {
            $products = $this->productService->getAllWithFilters($request->validated());
            $categories = $this->categoryService->getAll();
            $subCategories = $this->subCategoryService->getAll();

            return view('pages.products.index', compact('products', 'categories', 'subCategories'));
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Erro ao mostrar a página de produtos'. $e->getMessage());
        }
    }

    public function create(): View|RedirectResponse
    {
        try {            
            $categories = $this->categoryService->getAll();
            $subCategories = $this->subCategoryService->getAll();

            return view('pages.products.create', compact('categories', 'subCategories'));
        } catch (Exception $e) {
            return redirect()->route('categories.subcategories.index')->with('error', 'Erro ao mostrar página de cadastrar produtos');
        }
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id(); 

            $this->productService->create($data);

            return redirect()->route('products.create')->with('success', 'Produto criado com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('products.create')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('products.create')->with('error', 'Erro ao cadastrar produtos');
        }
    }

    public function edit(int $id): View|RedirectResponse
    {
        try {
            $product = $this->productService->getById($id);
            $categories = $this->categoryService->getAll();
            $subCategories = $this->subCategoryService->getAll();

            return View('pages.products.edit', compact('product', 'categories', 'subCategories'));
        } catch (ItemNotFoundException $e) {
            return redirect()->route('products.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Erro ao mostrar página de editar produto');
        }
    }

    public function update(int $id, UpdateProductRequest $request): RedirectResponse
    {
        try {
            $this->productService->update($id, $request->validated());

            return redirect()->route('products.edit', $id)->with('success', 'Produto editado com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('products.edit', $id)->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('products.edit', $id)->with('error', 'Erro ao editar produto');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            $this->productService->delete($request->id);

            return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso');
        } catch (ItemNotFoundException $e) {
            return redirect()->route('products.index')->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'Erro ao deletar produto');
        }
    }
}
