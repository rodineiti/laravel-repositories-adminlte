@extends('adminlte::page')

@section('title', 'Admin - Provas')

@section('content_header')
    <h1>Editar Prova: {{$test->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('tests.index')}}" title="tests" class="active">Provas</a></li>
        <li><a href="{{route('tests.edit', $test->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('tests.update', $test->id)}}" method="post">
    					@method('PUT')
    					@include('admin.tests._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
