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
                <label for="productId" class="form-label text-dark font-weight-bold mt-2">Produto</label>
                <select id="productId" class="form-control" name="product_id">
                    <option value="" disabled selected>Selecione um produto</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="quantity" class="form-label text-dark font-weight-bold mt-2">Quantidade:</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" class="form-control" placeholder="Digite a quantidade" min="1" required>
            </div>

            <div class="col-6 mb-3">
                <label for="control_number" class="form-label text-dark font-weight-bold mt-2">Número de Controle:</label>
                <input type="text" id="control_number" name="control_number" value="{{ old('control_number') }}" class="form-control" placeholder="Digite o número de controle">
            </div>

            <div class="col-6 mb-3">
                <label for="destination" class="form-label text-dark font-weight-bold mt-2">Destino:</label>
                <input type="text" id="destination" name="destination" value="{{ old('destination') }}" class="form-control" placeholder="Digite o destino">
            </div>

            <div class="col-6 d-flex gap-2 mt-2" id="buttonContainer">
                <input type="submit" class="btn btn-golden-rounded fw-semibold" value="Adicionar">
                <a href="{{ route('stockMovements.exit.index') }}" class="btn btn-golden-rounded fw-semibold mx-2">Voltar</a>
            </div>
        </form>
    </div>
</div>
@stop
