@extends('layouts.app')

@section('title', 'Produtos | Página inicial')

@section('page-specific-head')
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-dark">
        Produtos
    </div>

    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Filtrar resultados
        </div>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-golden-rounded fw-semibold">
                Novo produto
            </a>
        </div>
    </div>

    <form class="p-3 mt-2 rounded shadow-sm mb-2 bg-white" action="{{ route('products.index') }}" method="GET">
        @include('includes.alerts')

        <div class="row">
            <div class="col-4 mb-3">
                <label for="product-name" class="form-label text-dark font-weight-bold">Nome do produto:</label>
                <input type="text" id="product-name" class="form-control" name="name" placeholder="Digite o nome do produto">
            </div>
            <div class="col-4 mb-3">
                <label for="category-id" class="form-label text-dark font-weight-bold">Categoria:</label>
                <select id="category-id" class="form-control" name="category_id">
                    <option value="">Selecione uma categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4 mb-3">
                <label for="sub-category-id" class="form-label text-dark font-weight-bold">Subcategoria:</label>
                <select id="sub-category-id" class="form-control" name="sub_category_id">
                    <option value="">Selecione uma subcategoria</option>
                    @foreach($subCategories as $subcategory)
                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mt-2">
            <button type="submit" class="btn btn-golden-rounded fw-semibold">
                Filtrar
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-golden-rounded fw-semibold mx-2">
                Limpar filtros
            </a>
        </div>
    </form>

    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Lista de produtos
        </div>
    </div>

    <div class="p-3 mt-2 rounded-3 bg-white">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-dark">Nome</th>
                    <th scope="col" class="text-dark">Descrição</th>
                    <th scope="col" class="text-dark">Categoria</th>
                    <th scope="col" class="text-dark">Subcategoria</th>
                    <th scope="col" class="text-dark">Criador</th>
                    <th scope="col" class="text-dark">Estoque</th>
                    <th scope="col" class="text-dark">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if(count($products) > 0)
                    @foreach($products as $product)
                    <tr>
                        <td class="align-middle">{{ $product->name }}</td>
                        <td class="align-middle">{{ $product->description }}</td>
                        <td class="align-middle">{{ $product->category->name }}</td>
                        <td class="align-middle">{{ $product->subCategory->name }}</td>
                        <td class="align-middle">{{ $product->user->name }}</td>
                        <td class="align-middle">{{ $product->stock }}</td>
                        <td class="align-middle">
                            <a href="{{ route('products.stockMovements.showProductStockMovementsEntry', $product->id) }}" class="btn btn-sm btn-success btn-tooltip" title="Movimentação de entrada" data-toggle="tooltip">
                                <i class="fas fa-arrow-down"></i>
                            </a>
                        
                            <a href="{{ route('products.stockMovements.showProductStockMovementsExit', $product->id) }}" class="btn btn-sm btn-warning btn-tooltip" title="Movimentação de saída" data-toggle="tooltip">
                                <i class="fas fa-arrow-up"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary btn-tooltip" title="Editar produto" data-toggle="tooltip">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button class="btn btn-sm btn-danger btn-tooltip" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $product->id }}" title="Excluir produto" data-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">Não há produtos cadastrados.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@include('includes.modals.products.delete')

@stop

@section('page-specific-scripts')
<script src="{{ asset('js/products/modals/delete.js') }}"></script>
<script src="{{ asset('js/tooltip.js') }}"></script>
@stop
