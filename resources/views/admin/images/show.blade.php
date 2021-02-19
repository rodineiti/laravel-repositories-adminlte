@extends('adminlte::page')

@section('title', 'Admin - Imagens')

@section('content_header')
    <h1>Visualizando Item: {{$image->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('images.index')}}" title="images" class="active">Imagens</a></li>
        <li><a href="{{route('images.show', $image->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$image->id}}</p>
    				<p><strong>Nome: </strong>{{$image->name}}</p>
                    <p><strong>URL: </strong>{{$image->path_url}}</p>
                    <p>
                        <img src="{{$image->path_url}}" alt="{{$image->name}}" class="img-fluid">
                    </p>
    				<form action="{{route('images.destroy', $image->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
