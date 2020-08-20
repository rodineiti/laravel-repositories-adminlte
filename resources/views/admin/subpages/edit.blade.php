@extends('adminlte::page')

@section('title', 'Admin - Sub Páginas')

@section('content_header')
    <h1>Editar Página: {{$page->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('subpages.index')}}" title="subpages" class="active">Sub Páginas</a></li>
        <li><a href="{{route('subpages.edit', $page->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('subpages.update', $page->id)}}" method="post">
    					@method('PUT')
    					@include('admin.subpages._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
