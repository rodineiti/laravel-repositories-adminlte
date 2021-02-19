@extends('adminlte::page')

@section('title', 'Admin - Disciplinas')

@section('content_header')
    <h1>Editar Disciplina: {{$discipline->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('disciplines.index')}}" title="disciplines" class="active">Disciplinas</a></li>
        <li><a href="{{route('disciplines.edit', $discipline->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('disciplines.update', $discipline->id)}}" method="post">
    					@method('PUT')
    					@include('admin.disciplines._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
