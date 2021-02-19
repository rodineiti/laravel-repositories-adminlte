@extends('adminlte::page')

@section('title', 'Admin - Unidades de ensino')

@section('content_header')
    <h1>Editar Unidade: {{$unit->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('units.index')}}" title="units" class="active">Unidades de ensino</a></li>
        <li><a href="{{route('units.edit', $unit->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('units.update', $unit->id)}}" method="post">
    					@method('PUT')
    					@include('admin.units._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
