@extends('adminlte::page')

@section('title', 'Admin - Assuntos')

@section('content_header')
    <h1>Visualizando Item: {{$subject->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('subjects.index')}}" title="subjects" class="active">Assuntos</a></li>
        <li><a href="{{route('subjects.show', $subject->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$subject->id}}</p>
    				<p><strong>Nome: </strong>{{$subject->name}}</p>
    				<form action="{{route('subjects.destroy', $subject->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
