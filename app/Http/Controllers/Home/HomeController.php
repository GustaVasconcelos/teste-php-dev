<?php

namespace App\Http\Controllers\Home;

use App\Services\Product\ProductService;
use App\Services\SubCategory\SubCategoryService;
use App\Services\Category\CategoryService;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller 
{

    public function __construct
    (
        protected ProductService $productService,
        protected SubCategoryService $subCategoryService,
        protected CategoryService $categoryService
    )
    {}

    public function index(): View|RedirectResponse
    {
        try {
            $products = $this->productService->getAll();
            $categories = $this->categoryService->getAll();
            $subCategories = $this->subCategoryService->getAll();
            // $stockMovements = $this->stockMovementsService->getAll();
            
            return View('pages.home', compact('subCategories', 'categories', 'products'));
        } catch (Exception $e) {
            return redirect()->route('showLoginForm')->with('error', 'Erro ao mostrar a página inicial' );
        }
    }
}