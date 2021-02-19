@extends('adminlte::page')

@section('title', 'Admin - Provas')

@section('content_header')
    <h1>Adicionar Prova</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('tests.index')}}" title="tests" class="active">Provas</a></li>
        <li><a href="{{route('tests.create')}}" title="create" class="active">Adicionar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('tests.store')}}" method="post">
    					@include('admin.tests._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
