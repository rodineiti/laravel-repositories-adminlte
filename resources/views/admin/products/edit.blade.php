@extends('adminlte::page')

@section('title', 'Admin - Produtos')

@section('content_header')
    <h1>Editar Produto: {{$product->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('products.index')}}" title="products" class="active">Produtos</a></li>
        <li><a href="{{route('products.edit', $product->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('products.update', $product->id)}}" method="post">
    					@method('PUT')
    					@include('admin.products._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
