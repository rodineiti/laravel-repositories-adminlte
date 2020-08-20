@extends('adminlte::page')

@section('title', 'Admin - Usuários')

@section('content_header')
    <h1>Editar Usuário: {{$user->name}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('users.index')}}" title="users" class="active">Usuários</a></li>
        <li><a href="{{route('users.edit', $user->id)}}" title="edit" class="active">Editar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('users.update', $user->id)}}" method="post">
    					@method('PUT')
    					@include('admin.users._partials.form')
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@stop
