@extends('layouts.app')

@section('title', 'Categorias | Sub Categorias | Cadastro')

@section('page-specific-head')
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-dark">
        Categorias <i class="fas fa-chevron-right mx-1"></i> Sub Categorias<i class="fas fa-chevron-right mx-1"></i> Cadastro
    </div>
    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Cadastrar Sub Categoria
        </div>
    </div>
    <div class="p-3 mt-2 rounded shadow-sm mb-2 bg-white">
        @include('includes.alerts')

        <form action="{{ route('categories.subcategories.store', $categoryId) }}" method="post" class="row" enctype="multipart/form-data">
            @csrf

            <div class="col-12 mb-3">
                <label for="name" class="form-label text-dark font-weight-bold mt-2">Nome:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="Digite o nome da sub categoria">
            </div>

            <div class="col-12 d-flex gap-2 mt-2" id="buttonContainer">
                <input type="submit" class="btn btn-golden-rounded fw-semibold" value="Adicionar">
                <a href="{{ route('categories.subcategories.index', $categoryId) }}" class="btn btn-golden-rounded fw-semibold mx-2">Voltar</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-specific-scripts')
@stop
