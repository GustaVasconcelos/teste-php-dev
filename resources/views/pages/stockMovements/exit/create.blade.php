@extends('layouts.app')

@section('title', 'Movimentos de Estoque | Saída | Cadastro')

@section('page-specific-head')
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-dark">
        Movimentos de Estoque <i class="fas fa-chevron-right mx-1"></i> Cadastro
    </div>
    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Cadastrar Movimentação de Estoque (Saída)
        </div>
    </div>
    <div class="p-3 mt-2 rounded shadow-sm mb-2 bg-white">
        @include('includes.alerts')

        <form action="{{ route('stockMovements.exit.store') }}" method="post" class="row">
            @csrf

            <div class="d-flex flex-column col-6">
                <label for="productId0" class="form-label text-dark font-weight-bold mt-2">Produto</label>
                <select id="productId0" class="form-control" name="entries[0][product_id]">
                    <option value="" disabled selected>Selecione um produto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('entries.0.product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 mb-3">
                <label for="quantity0" class="form-label text-dark font-weight-bold mt-2">Quantidade:</label>
                <input type="number" id="quantity0" name="entries[0][quantity]" class="form-control" placeholder="Digite a quantidade" min="1" value="{{ old('entries.0.quantity') }}" required>
            </div>
            <div class="col-6 mb-3">
                <label for="control_number0" class="form-label text-dark font-weight-bold mt-2">Número de Controle:</label>
                <input type="text" id="control_number0" name="entries[0][control_number]" class="form-control" placeholder="Digite o número de controle" value="{{ old('entries.0.control_number') }}">
            </div>
            <div class="col-6 mb-3">
                <label for="destination0" class="form-label text-dark font-weight-bold mt-2">Destino:</label>
                <input type="text" id="destination0" name="entries[0][destination]" class="form-control" placeholder="Digite o destino" value="{{ old('entries.0.destination') }}">
            </div>
            <hr>

            <div id="entries-container" class="container-fluid" style="padding-inline: 0.9rem;"></div>

            <div class="col-12 d-flex gap-2 mt-2">
                <button type="button" id="add-entry" class="btn btn-golden-rounded fw-semibold">Adicionar Outra Saída</button>
                <input type="submit" class="btn btn-golden-rounded fw-semibold mx-3" value="Adicionar">
                <a href="{{ route('stockMovements.exit.index') }}" class="btn btn-golden-rounded fw-semibold">Voltar</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-specific-scripts')
    <script>
        const productsOptions = @json($products);
    </script>
    <script src="{{ asset('js/stockMovements/exit/dynamic-fields-create.js') }}"></script>
@stop
