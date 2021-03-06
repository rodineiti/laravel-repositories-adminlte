@extends('adminlte::page')

@section('title', 'Admin - Assuntos')

@section('content_header')
    <h1>Editar Assunto: {{$subject->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('subjects.index')}}" title="subjects" class="active">Assuntos</a></li>
        <li><a href="{{route('subjects.edit', $subject->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('subjects.update', $subject->id)}}" method="post">
    					@method('PUT')
    					@include('admin.subjects._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
