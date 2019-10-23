@extends('adminlte::page')

@section('title', 'Admin - Categorias')

@section('content_header')
    <h1>Visualizando Categoria: {{$category->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('categories.index')}}" title="categories" class="active">Categorias</a></li>
        <li><a href="{{route('categories.show', $category->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$category->id}}</p>
    				<p><strong>Título: </strong>{{$category->title}}</p>
    				<p><strong>Url: </strong>{{$category->url}}</p>
    				<p><strong>Descrição: </strong>{{$category->description}}</p>
    				<hr>
    				<form action="{{route('categories.destroy', $category->id)}}" method="post">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
