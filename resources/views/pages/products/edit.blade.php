@extends('layouts.app')

@section('title', 'Produtos | Edição')

@section('page-specific-head')
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-dark">
        Produtos <i class="fas fa-chevron-right mx-1"></i> Edição
    </div>
    <div class="mt-4 d-flex justify-content-between alinhamento-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Editar produto
        </div>
    </div>
    <div class="p-3 mt-2 rounded shadow-sm mb-2 bg-white">
        @include('includes.alerts')

        <form action="{{ route('products.update', $product->id) }}" method="post" class="row" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-12 mb-3">
                <label for="name" class="form-label text-dark font-weight-bold mt-2">Nome:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="Digite o nome do produto">
            </div>

            <div class="col-12 mb-3">
                <label for="description" class="form-label text-dark font-weight-bold mt-2">Descrição:</label>
                <textarea id="description" name="description" class="form-control" placeholder="Digite a descrição do produto">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="col-6 mb-3">
                <label for="category-id" class="form-label text-dark font-weight-bold mt-2">Categoria:</label>
                <select id="category-id" class="form-control" name="category_id">
                    <option value="">Selecione uma categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="sub-category-id" class="form-label text-dark font-weight-bold mt-2">Subcategoria:</label>
                <select id="sub-category-id" class="form-control" name="sub_category_id">
                    <option value="" disabled>Selecione uma subcategoria</option>
                    @foreach($subCategories as $subCategory)
                        <option value="{{ $subCategory->id }}" data-category="{{ $subCategory->category_id }}" {{ $product->sub_category_id == $subCategory->id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 d-flex gap-2 mt-2" id="buttonContainer">
                <input type="submit" class="btn btn-golden-rounded fw-semibold" value="Atualizar">
                <a href="{{ route('products.index') }}" class="btn btn-golden-rounded fw-semibold mx-2">Voltar</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('page-specific-scripts')
<script src="{{ asset('js/products/dynamic-fields-update.js') }}"></script>
@stop
