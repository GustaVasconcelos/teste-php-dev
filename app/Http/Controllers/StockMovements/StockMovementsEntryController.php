<?php

namespace App\Http\Controllers\StockMovements;

use App\Services\StockMovements\StockMovementsEntryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockMovements\Entry\StoreEntryStockMovementRequest;
use App\Services\Product\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class StockMovementsEntryController extends Controller 
{

    public function __construct
    (
        protected StockMovementsEntryService $stockMovementsEntryService,
        protected ProductService $productService
    )
    {}

    public function index(): View|RedirectResponse
    {
        try {
            $stockMovements = $this->stockMovementsEntryService->getAll();
            
            return View('pages.stockMovements.entry.index', compact('stockMovements'));
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Erro ao mostrar página de movimento de estoque' . $e->getMessage());
        }
    } 
    
    public function create(): View|RedirectResponse
    {
        try {
            $products = $this->productService->getAll();

            return View('pages.stockMovements.entry.create', compact('products'));
        }  catch (Exception $e) {
            return redirect()->route('stockMovements.entry.index')->with('error', 'Erro ao mostrar página de cadastro de movimento de estoque');
        }
    }

    public function store(StoreEntryStockMovementRequest $request): RedirectResponse
    {
        try {
            $this->stockMovementsEntryService->create($request->validated());

            return redirect()->route('stockMovements.entry.create')->with('success', 'Novo movimento de estoque cadastrado');
        }  catch (Exception $e) {
            return redirect()->route('stockMovements.entry.create')->with('error', 'Erro ao mostrar página de cadastro de movimento de estoque' . $e->getMessage());
        }
    }
}