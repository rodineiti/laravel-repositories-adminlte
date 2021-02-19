@extends('adminlte::page')

@section('title', 'Admin - Disciplinas')

@section('content_header')
    <h1>Adicionar Disciplina</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('disciplines.index')}}" title="disciplines" class="active">Disciplinas</a></li>
        <li><a href="{{route('disciplines.create')}}" title="create" class="active">Adicionar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('disciplines.store')}}" method="post">
    					@include('admin.disciplines._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
