@extends('adminlte::page')

@section('title', 'Admin - Páginas')

@section('content_header')
    <h1>Adicionar Página</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('pages.index')}}" title="pages" class="active">Páginas</a></li>
        <li><a href="{{route('pages.create')}}" title="create" class="active">Adicionar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('pages.store')}}" method="post">
    					@include('admin.pages._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
