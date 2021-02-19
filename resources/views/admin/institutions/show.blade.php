@extends('adminlte::page')

@section('title', 'Admin - Instituições')

@section('content_header')
    <h1>Visualizando Item: {{$institution->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('institutions.index')}}" title="institutions" class="active">Instituições</a></li>
        <li><a href="{{route('institutions.show', $institution->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$institution->id}}</p>
    				<p><strong>Nome: </strong>{{$institution->name}}</p>
    				<form action="{{route('institutions.destroy', $institution->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
