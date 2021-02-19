@extends('adminlte::page')

@section('title', 'Admin - Tipos de oferta')

@section('content_header')
    <h1>Editar Tipo: {{$offer->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('offertypes.index')}}" title="offertypes" class="active">Tipos de oferta</a></li>
        <li><a href="{{route('offertypes.edit', $offer->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('offertypes.update', $offer->id)}}" method="post">
    					@method('PUT')
    					@include('admin.offertypes._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
