@extends('adminlte::page')

@section('title', 'Admin - Perfil')

@section('content_header')
    <h1>Editar perfil</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
        <div class="row">
            <div class="box box-success">
                <div class="box-body">
                    @include('admin.includes.alerts')
                    <form action="{{route('profile.update')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->name}}" placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{auth()->user()->email}}" placeholder="E-mail">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="Senha">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar senha</label>
                            <input type="password" class="form-control" id="password_confirmation" value="" name="password_confirmation" placeholder="Confirmar senha">
                        </div>
                        <button type="submit" class="btn btn-success">Salvar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
