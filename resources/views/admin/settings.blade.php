@extends('adminlte::page')

@section('title', 'Admin - Configurações do site')

@section('content_header')
    <h1>Editar configurações do site</h1>
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
                    <form action="{{route('settings.update')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Título do Site</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{$setting["title"] ?? old("title")}}" placeholder="Título do site">
                        </div>
                        <div class="form-group">
                            <label for="subtitle">Subtitulo do Site</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle"
                                   value="{{$setting["subtitle"] ?? old("subtitle")}}" placeholder="Sutitulo do site">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail de contato</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{$setting["email"] ?? old("email")}}" placeholder="E-mail de contato do site">
                        </div>
                        <div class="form-group">
                            <label for="bgcolor">Cor de fundo do site</label>
                            <input type="color" class="form-control" id="bgcolor" name="bgcolor"
                                   value="{{$setting["bgcolor"] ?? old("bgcolor")}}" placeholder="Cor de fundo do site">
                        </div>
                        <div class="form-group">
                            <label for="textcolor">Cor das letras do site</label>
                            <input type="color" class="form-control" id="textcolor" name="textcolor"
                                   value="{{$setting["textcolor"] ?? old("textcolor")}}"  placeholder="Cor das letras do site">
                        </div>
                        <button type="submit" class="btn btn-success">Salvar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
