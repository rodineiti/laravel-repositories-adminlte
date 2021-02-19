@extends('adminlte::page')

@section('title', 'Admin - Disciplinas')

@section('content_header')
    <h1>Visualizando Item: {{$discipline->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('disciplines.index')}}" title="disciplines" class="active">Disciplinas</a></li>
        <li><a href="{{route('disciplines.show', $discipline->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$discipline->id}}</p>
    				<p><strong>Nome: </strong>{{$discipline->name}}</p>
    				<form action="{{route('disciplines.destroy', $discipline->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
