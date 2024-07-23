@extends('layouts.app')

@section('title', 'Dashboard | Página inicial')

@section('page-specific-head')
@stop

@section('content')
<div class="container-fluid">

    <!-- Content Row -->
    @include('includes.alerts')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Produtos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if ($products->count() == 0)
                                    Nenhum produto cadastrado
                                @else
                                    {{ $products->count()}}
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Categorias</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if ($categories->count() == 0)
                                    Nenhuma categoria cadastrada
                                @else
                                    {{ $categories->count()}}
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sub categorias
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        @if ($subCategories->count() == 0)
                                            Nenhum cupom cadastrado
                                        @else
                                            {{ $subCategories->count()}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Movimentos de estoque
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{-- @if ($stockMovements->count() == 0)
                                    Nenhum movimento de estoque cadastrado
                                @else
                                    {{ $stockMovements->count()}}
                                @endif --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-specific-scripts')

@stop