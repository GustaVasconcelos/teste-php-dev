@extends('layouts.app')

@section('title', 'Movimentos de Estoque | Entrada')

@section('page-specific-head')
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-dark">
        Movimentos de estoque <i class="fas fa-chevron-right mx-1"></i> Entrada
    </div>

    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Filtrar resultados
        </div>
        <div>
            <a href="{{ route('stockMovements.entry.create') }}" class="btn btn-golden-rounded fw-semibold mx-2">Nova Entrada</a>
        </div>
    </div>

    <form class="p-3 mt-2 rounded shadow-sm mb-2 bg-white" action="{{ route('stockMovements.entry.index') }}" method="GET">
        @include('includes.alerts')

        <div class="row">
            <div class="col-6 mb-3">
                <label for="product-name" class="form-label text-dark font-weight-bold">Nome do Produto:</label>
                <input type="text" id="product-name" class="form-control" name="product_name" placeholder="Digite o nome do produto">
            </div>
            <div class="col-6 mb-3">
                <label for="date" class="form-label text-dark font-weight-bold">Data:</label>
                <input type="date" id="date" class="form-control" name="date">
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mt-2">
            <button type="submit" class="btn btn-golden-rounded fw-semibold">
                Filtrar
            </button>
            <a href="{{ route('stockMovements.entry.index') }}" class="btn btn-golden-rounded fw-semibold mx-2">
                Limpar filtros
            </a>
        </div>
    </form>

    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Lista de Movimentos de Entrada de Estoque
        </div>
    </div>

    <div class="p-3 mt-2 rounded-3 bg-white">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-dark">Produto</th>
                    <th scope="col" class="text-dark">Quantidade</th>
                    <th scope="col" class="text-dark">Quantidade Anterior</th>
                    <th scope="col" class="text-dark">Data</th>
                    <th scope="col" class="text-dark">Número da Nota Fiscal</th>
                    <th scope="col" class="text-dark">Fornecedor</th>
                </tr>
            </thead>
            <tbody>
                @if(count($stockMovements) > 0)
                    @foreach($stockMovements as $movement)
                    <tr>
                        <td class="align-middle">{{ $movement->product->name }}</td>
                        <td class="align-middle">{{ $movement->quantity }}</td>
                        <td class="align-middle">{{ $movement->previous_quantity }}</td>
                        <td class="align-middle">{{ $movement->created_at->format('d/m/Y') }}</td>
                        <td class="align-middle">{{ $movement->invoice_number }}</td>
                        <td class="align-middle">{{ $movement->supplier }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Não há movimentos de entrada de estoque cadastrados.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop

@section('page-specific-scripts')
@stop
