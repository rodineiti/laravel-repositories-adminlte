@extends('adminlte::page')

@section('title', 'Admin - Usuários')

@section('content_header')
    <h1>Usuários</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.home')}}" title="dashboard">Dashboard</a>
        </li>
        <li>
            <a href="{{route('users.index')}}" title="users" class="active">Categorias</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				<form action="{{route('users.search')}}" method="post" class="form-inline">
    					@csrf
    					<input type="text" name="name" id="name" placeholder="Nome" class="form-control" value="{{$filters['name'] ?? ''}}">
    					<input type="text" name="email" id="email" placeholder="E-mail" class="form-control" value="{{$filters['email'] ?? ''}}">
    					<button type="submit" class="btn btn-default">Buscar</button>
    				</form>

    				@if(isset($filters))
    					<a href="{{route('users.index')}}" title="clear">(X) Limpar resultados da pesquisa</a>
    				@endif
    			</div>
    		</div>
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<span class="pull-right"><a class="btn btn-primary" href="{{route('users.create')}}" title="create">Adicionar</a></span>
    				<table class="table table-striped">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th>Nome</th>
    							<th>E-mail</th>
    							<th>Administrador</th>
    							<th>Ações</th>
    						</tr>
    					</thead>
    					<tbody>
    						@foreach($users as $user)
    							<tr>
    								<td>{{$user->id}}</td>
    								<td>{{$user->name}}</td>
    								<td>{{$user->email}}</td>
    								<td>{{$user->admin === "1" ? "Sim" : "Não" }}</td>
    								<td>
    									<a href="{{route('users.edit', $user->id)}}" title="edit" class="badge bg-yellow">
    										Editar
    									</a>
    									<a href="{{route('users.show', $user->id)}}" title="show" class="badge bg-blue">
    										Visualizar
    									</a>
    								</td>
    							</tr>
    						@endforeach
    					</tbody>
    				</table>
    				@if(isset($filters))
    					{!!$users->appends($filters)->links()!!}
    				@else
    					{!!$users->links()!!}
    				@endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
