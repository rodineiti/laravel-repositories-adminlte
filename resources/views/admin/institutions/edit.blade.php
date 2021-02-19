@extends('adminlte::page')

@section('title', 'Admin - Instituições')

@section('content_header')
    <h1>Editar Instituição: {{$institution->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('institutions.index')}}" title="institutions" class="active">Instituições</a></li>
        <li><a href="{{route('institutions.edit', $institution->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('institutions.update', $institution->id)}}" method="post">
    					@method('PUT')
    					@include('admin.institutions._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
