@extends('adminlte::page')

@section('title', 'Admin - Assuntos')

@section('content_header')
    <h1>Adicionar Assunto</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('subjects.index')}}" title="subjects" class="active">Assuntos</a></li>
        <li><a href="{{route('subjects.create')}}" title="create" class="active">Adicionar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('subjects.store')}}" method="post">
    					@include('admin.subjects._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
