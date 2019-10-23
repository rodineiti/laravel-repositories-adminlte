@extends('adminlte::page')

@section('title', 'Admin - Categorias')

@section('content_header')
    <h1>Editar Categoria: {{$category->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('categories.index')}}" title="categories" class="active">Categorias</a></li>
        <li><a href="{{route('categories.edit', $category->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('categories.update', $category->id)}}" method="post">
    					@method('PUT')
    					@include('admin.categories._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
