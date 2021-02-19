@extends('adminlte::page')

@section('title', 'Admin - Unidades de ensino')

@section('content_header')
    <h1>Visualizando Item: {{$unit->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('units.index')}}" title="units" class="active">Unidades de ensino</a></li>
        <li><a href="{{route('units.show', $unit->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$unit->id}}</p>
    				<p><strong>Nome: </strong>{{$unit->name}}</p>
    				<form action="{{route('units.destroy', $unit->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
