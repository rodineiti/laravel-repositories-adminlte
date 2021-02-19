@extends('adminlte::page')

@section('title', 'Admin - Imagens')

@section('content_header')
    <h1>Editar Imagem: {{$image->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('images.index')}}" title="images" class="active">Imagens</a></li>
        <li><a href="{{route('images.edit', $image->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('images.update', $image->id)}}" method="post" enctype="multipart/form-data">
    					@method('PUT')
    					@include('admin.images._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
