@extends('layouts.auth')

@section('title', 'TestePhP | Cadastro')

@section('content')

<div class="container vh-100 justify-content-center align-items-center">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Cadastro</h1>
                                </div>

                                @include('includes.alerts')

                                <form action="{{ route('store') }}" method="POST" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control form-control-user" 
                                             placeholder="Insira seu nome" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user"
                                             placeholder="Insira seu email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                             placeholder="Senha">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user"
                                             placeholder="Confirmação de senha">
                                    </div>

                                    <button type="submit" class="btn btn-outline-warning btn-block">
                                        Cadastrar
                                    </button>
                                    <hr>
                                </form>

                                <div class="text-center">
                                    <a class="small" href="{{ route('showLoginForm') }}">Já tem uma conta? Faça login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
