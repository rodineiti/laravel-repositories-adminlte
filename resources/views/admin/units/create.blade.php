@extends('adminlte::page')

@section('title', 'Admin - Unidades de Ensino')

@section('content_header')
    <h1>Adicionar Unidade</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('units.index')}}" title="units" class="active">Unidades de Ensino</a></li>
        <li><a href="{{route('units.create')}}" title="create" class="active">Adicionar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('units.store')}}" method="post">
    					@include('admin.units._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
