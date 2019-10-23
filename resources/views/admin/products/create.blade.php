@extends('adminlte::page')

@section('title', 'Admin - Produtos')

@section('content_header')
    <h1>Adicionar Produto</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('products.index')}}" title="products" class="active">Produtos</a></li>
        <li><a href="{{route('products.create')}}" title="create" class="active">Adicionar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('products.store')}}" method="post">
    					@include('admin.products._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
