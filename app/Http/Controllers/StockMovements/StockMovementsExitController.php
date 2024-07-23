<?php

namespace App\Http\Controllers\StockMovements;

use App\Services\StockMovements\StockMovementsExitService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;
use App\Exceptions\InsufficientStockException;
use App\Http\Requests\StockMovements\ExitRequest\StoreExitStockMovementRequest;
use App\Http\Requests\StockMovements\FilterStockRequest;
use App\Services\Product\ProductService;

class StockMovementsExitController extends Controller 
{

    public function __construct
    (
        protected StockMovementsExitService $stockMovementsExitService,
        protected ProductService $productService
    )
    {}

    public function index(FilterStockRequest $request): View|RedirectResponse
    {
        try {
            $stockMovements = $this->stockMovementsExitService->getAllWithFilters($request->validated());
            
            return View('pages.stockMovements.exit.index', compact('stockMovements'));
        } catch (Exception $e) {
            return redirect()->route('home')->with('error', 'Erro ao mostrar página de movimento de estoque' );
        }
    } 
    
    public function create(): View|RedirectResponse
    {
        try {
            $products = $this->productService->getAll();

            return View('pages.stockMovements.exit.create', compact('products'));
        }  catch (Exception $e) {
            return redirect()->route('stockMovements.exit.index')->with('error', 'Erro ao mostrar página de cadastro de movimento de estoque');
        }
    }

    public function store(StoreExitStockMovementRequest $request): RedirectResponse
    {
        try {
            $this->stockMovementsExitService->create($request->validated()['entries']);

            return redirect()->route('stockMovements.exit.create')->with('success', 'Novo movimento de estoque cadastrado');
        } catch (InsufficientStockException $e) {
            return redirect()->route('stockMovements.exit.create')->with('warning', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('stockMovements.exit.create')->with('error', 'Erro ao mostrar página de cadastro de movimento de estoque');
        }
    }
}