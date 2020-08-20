@extends('adminlte::page')

@section('title', 'Admin - Usuários')

@section('content_header')
    <h1>Visualizando Usuário: {{$user->name}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('users.index')}}" title="users" class="active">Usuários</a></li>
        <li><a href="{{route('users.show', $user->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$user->id}}</p>
    				<p><strong>Nome: </strong>{{$user->name}}</p>
    				<p><strong>E-mail: </strong>{{$user->email}}</p>
    				<p><strong>Administrador: </strong>{{$user->admin === "1" ? "Sim" : "Não" }}</p>
    				<hr>
                    @if(auth()->id() !== $user->id)
    				<form action="{{route('users.destroy', $user->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
    					@csrf
    					@method('DELETE')
    					<button type="submit" class="btn btn-danger">Deletar</button>
    				</form>
                    @endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
