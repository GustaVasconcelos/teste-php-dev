@extends('layouts.app')

@section('title', 'Produtos | Movimentos de Estoque | Saída')

@section('page-specific-head')
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-dark">
        Produtos <i class="fas fa-chevron-right mx-1"></i> Movimentos de estoque <i class="fas fa-chevron-right mx-1"></i> Saída
    </div>

    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Lista de Movimentos de Saída de Estoque
        </div>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-golden-rounded fw-semibold mx-2">Voltar</a>
        </div>
    </div>

    <div class="p-3 mt-2 rounded-3 bg-white">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-dark">Produto</th>
                    <th scope="col" class="text-dark">Quantidade Retirada</th>
                    <th scope="col" class="text-dark">Quantidade Anterior</th>
                    <th scope="col" class="text-dark">Data</th>
                    <th scope="col" class="text-dark">Número de Controle</th>
                    <th scope="col" class="text-dark">Destino</th>
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
                        <td class="align-middle">{{ $movement->control_number }}</td>
                        <td class="align-middle">{{ $movement->destination }}</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Não há movimentos de saída de estoque cadastrados para este produto.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop

@section('page-specific-scripts')
@stop
