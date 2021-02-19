@extends('adminlte::page')

@section('title', 'Admin - Imagens')

@section('content_header')
    <h1>Imagens</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.home')}}" title="dashboard">Dashboard</a>
        </li>
        <li>
            <a href="{{route('images.index')}}" title="images" class="active">Imagens</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				<form action="{{route('images.search')}}" method="post" class="form-inline">
    					@csrf
    					<input type="text" name="title" id="title" placeholder="Título" class="form-control" value="{{$filters['title'] ?? ''}}">
    					<button type="submit" class="btn btn-default">Buscar</button>
    				</form>

    				@if(isset($filters))
    					<a href="{{route('images.index')}}" title="clear">(X) Limpar resultados da pesquisa</a>
    				@endif
    			</div>
    		</div>
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<span class="pull-right"><a class="btn btn-primary" href="{{route('images.create')}}" title="create">Adicionar</a></span>
    				<table class="table table-striped">
    					<thead>
    						<tr>
    							<th>#</th>
                                <th>Imagem</th>
    							<th>Nome</th>
                                <th>URL</th>
    							<th>Ações</th>
    						</tr>
    					</thead>
    					<tbody>
    						@foreach($images as $item)
    							<tr>
    								<td>{{$item->id}}</td>
                                    <td>
                                        <img src="{{$item->path_url}}" alt="{{$item->name}}" class="img-fluid">
                                    </td>
    								<td>{{$item->name}}</td>
                                    <td>{{$item->path_url}}</td>
    								<td>
    									<a href="{{route('images.edit', $item->id)}}" title="edit" class="badge bg-yellow">
    										Editar
    									</a>
    									<a href="{{route('images.show', $item->id)}}" title="show" class="badge bg-blue">
    										Visualizar
    									</a>
    								</td>
    							</tr>
    						@endforeach
    					</tbody>
    				</table>
    				@if(isset($filters))
    					{!!$images->appends($filters)->links()!!}
    				@else
    					{!!$images->links()!!}
    				@endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
