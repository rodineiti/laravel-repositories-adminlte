@extends('adminlte::page')

@section('title', 'Admin - Disciplinas')

@section('content_header')
    <h1>Disciplinas</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.home')}}" title="dashboard">Dashboard</a>
        </li>
        <li>
            <a href="{{route('disciplines.index')}}" title="disciplines" class="active">Disciplinas</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				<form action="{{route('disciplines.search')}}" method="post" class="form-inline">
    					@csrf
    					<input type="text" name="title" id="title" placeholder="Título" class="form-control" value="{{$filters['title'] ?? ''}}">
    					<button type="submit" class="btn btn-default">Buscar</button>
    				</form>

    				@if(isset($filters))
    					<a href="{{route('disciplines.index')}}" title="clear">(X) Limpar resultados da pesquisa</a>
    				@endif
    			</div>
    		</div>
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<span class="pull-right"><a class="btn btn-primary" href="{{route('disciplines.create')}}" title="create">Adicionar</a></span>
    				<table class="table table-striped">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th>Nome</th>
    							<th>Ações</th>
    						</tr>
    					</thead>
    					<tbody>
    						@foreach($disciplines as $item)
    							<tr>
    								<td>{{$item->id}}</td>
    								<td>{{$item->name}}</td>
    								<td>
    									<a href="{{route('disciplines.edit', $item->id)}}" title="edit" class="badge bg-yellow">
    										Editar
    									</a>
    									<a href="{{route('disciplines.show', $item->id)}}" title="show" class="badge bg-blue">
    										Visualizar
    									</a>
    								</td>
    							</tr>
    						@endforeach
    					</tbody>
    				</table>
    				@if(isset($filters))
    					{!!$disciplines->appends($filters)->links()!!}
    				@else
    					{!!$disciplines->links()!!}
    				@endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
