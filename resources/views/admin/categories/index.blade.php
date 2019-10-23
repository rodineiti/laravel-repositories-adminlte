@extends('adminlte::page')

@section('title', 'Admin - Categorias')

@section('content_header')
    <h1>Categorias</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('home')}}" title="dashboard">Dashboard</a>
        </li>
        <li>
            <a href="{{route('categories.index')}}" title="categories" class="active">Categorias</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				<form action="{{route('categories.search')}}" method="post" class="form-inline">
    					@csrf
    					<input type="text" name="title" id="title" placeholder="Título" class="form-control" value="{{$filters['title'] ?? ''}}">
    					<input type="text" name="description" id="description" placeholder="Descrição" class="form-control" value="{{$filters['description'] ?? ''}}">
    					<button type="submit" class="btn btn-default">Buscar</button>
    				</form>

    				@if(isset($filters))
    					<a href="{{route('categories.index')}}" title="clear">(X) Limpar resultados da pesquisa</a>
    				@endif
    			</div>
    		</div>
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<span class="pull-right"><a class="btn btn-primary" href="{{route('categories.create')}}" title="create">Adicionar</a></span>
    				<table class="table table-striped">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th>Título</th>
    							<th>Descrição</th>
    							<th>Ações</th>
    						</tr>
    					</thead>
    					<tbody>
    						@foreach($categories as $category)
    							<tr>
    								<td>{{$category->id}}</td>
    								<td>{{$category->title}}</td>
    								<td>{{$category->description}}</td>
    								<td>
    									<a href="{{route('categories.edit', $category->id)}}" title="edit" class="badge bg-yellow">
    										Editar
    									</a>
    									<a href="{{route('categories.show', $category->id)}}" title="show" class="badge bg-blue">
    										Visualizar
    									</a>
    								</td>
    							</tr>
    						@endforeach
    					</tbody>
    				</table>
    				@if(isset($filters))
    					{!!$categories->appends($filters)->links()!!}
    				@else
    					{!!$categories->links()!!}
    				@endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
