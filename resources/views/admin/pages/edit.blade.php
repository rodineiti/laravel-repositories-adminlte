@extends('adminlte::page')

@section('title', 'Admin - Páginas')

@section('content_header')
    <h1>Editar Página: {{$page->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('pages.index')}}" title="pages" class="active">Páginas</a></li>
        <li><a href="{{route('pages.edit', $page->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('pages.update', $page->id)}}" method="post">
    					@method('PUT')
    					@include('admin.pages._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
