@extends('adminlte::page')

@section('title', 'Admin - Tipos de oferta')

@section('content_header')
    <h1>Adicionar Tipo</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('offertypes.index')}}" title="offertypes" class="active">Tipos de oferta</a></li>
        <li><a href="{{route('offertypes.create')}}" title="create" class="active">Adicionar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('offertypes.store')}}" method="post">
    					@include('admin.offertypes._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
