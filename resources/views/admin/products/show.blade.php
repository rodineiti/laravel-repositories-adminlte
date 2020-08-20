@extends('adminlte::page')

@section('title', 'Admin - Produtos')

@section('content_header')
    <h1>Visualizando Produto: {{$product->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('products.index')}}" title="products" class="active">Produtos</a></li>
        <li><a href="{{route('products.show', $product->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$product->id}}</p>
    				<p><strong>Título: </strong>{{$product->title}}</p>
    				<p><strong>Url: </strong>{{$product->url}}</p>
    				<p><strong>Descrição: </strong>{{$product->description}}</p>
    				<hr>
    				<form action="{{route('products.destroy', $product->id)}}" method="post">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
