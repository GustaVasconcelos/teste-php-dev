@extends('layouts.app')

@section('title', 'Categorias | Página inicial')

@section('page-specific-head')
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container-fluid">
    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 text-dark">
        Categorias
    </div>

    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Filtrar resultados
        </div>
        <div>
            <a href="{{ route('categories.create') }}" class="btn btn-golden-rounded fw-semibold">
                Nova categoria
            </a>
        </div>
    </div>

    <form class="p-3 mt-2 rounded shadow-sm mb-2 bg-white" action="{{ route('categories.index') }}" method="GET">
        @include('includes.alerts')

        <div class="row">
            <div class="col-12 mb-3">
                <label for="category-name" class="form-label text-dark font-weight-bold">Nome da categoria:</label>
                <input type="text" id="category-name" class="form-control" name="name" placeholder="Digite o nome da categoria">
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mt-2">
            <button type="submit" class="btn btn-golden-rounded fw-semibold">
                Filtrar
            </button>
            <a href="{{ route('categories.index') }}" class="btn btn-golden-rounded fw-semibold mx-2">
                Limpar filtros
            </a>
        </div>
    </form>

    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
        <div class="font-weight-bold text-primary text-uppercase mb-1 text-dark d-flex">
            Lista de categorias
        </div>
    </div>

    <div class="p-3 mt-2 rounded-3 bg-white">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-dark">Nome</th>
                    <th scope="col" class="text-dark">Ações</th>
                </tr>
            </thead>
            <tbody>
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                    <tr>
                        <td class="align-middle">
                            {{ $category->name }}
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary btn-tooltip" title="Editar categoria" data-toggle="tooltip">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <button class="btn btn-sm btn-danger btn-tooltip" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $category->id }}" title="Excluir categoria" data-toggle="tooltip">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="text-center">Não há categorias cadastradas.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@include('includes.modals.categories.delete')

@stop

@section('page-specific-scripts')
<script src="{{ asset('js/category/modals/delete.js') }}"></script>
<script src="{{ asset('js/tooltip.js') }}"></script>
@stop
