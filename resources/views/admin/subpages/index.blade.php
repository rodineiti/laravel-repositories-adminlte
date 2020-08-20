@extends('adminlte::page')

@section('title', 'Admin - Sub Páginas')

@section('content_header')
    <h1>Sub Páginas</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.home')}}" title="dashboard">Dashboard</a>
        </li>
        <li>
            <a href="{{route('subpages.index')}}" title="subpages" class="active">Sub Páginas</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				<form action="{{route('subpages.search')}}" method="post" class="form-inline">
    					@csrf
    					<input type="text" name="title" id="title" placeholder="Título" class="form-control" value="{{$filters['title'] ?? ''}}">
    					<button type="submit" class="btn btn-default">Buscar</button>
    				</form>

    				@if(isset($filters))
    					<a href="{{route('subpages.index')}}" title="clear">(X) Limpar resultados da pesquisa</a>
    				@endif
    			</div>
    		</div>
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<span class="pull-right"><a class="btn btn-primary" href="{{route('subpages.create')}}" title="create">Adicionar</a></span>
    				<table class="table table-striped">
    					<thead>
    						<tr>
    							<th>#</th>
                                <th>Página Principal</th>
    							<th>Título</th>
    							<th>Slug</th>
    							<th>Ações</th>
    						</tr>
    					</thead>
    					<tbody>
    						@foreach($subpages as $page)
    							<tr>
    								<td>{{$page->id}}</td>
    								<td>{{$page->page->title}}</td>
    								<td>{{$page->title}}</td>
    								<td>{{$page->slug}}</td>
    								<td>
    									<a href="{{route('subpages.edit', $page->id)}}" title="edit" class="badge bg-yellow">
    										Editar
    									</a>
    									<a href="{{route('subpages.show', $page->id)}}" title="show" class="badge bg-blue">
    										Visualizar
    									</a>
    								</td>
    							</tr>
    						@endforeach
    					</tbody>
    				</table>
    				@if(isset($filters))
    					{!!$subpages->appends($filters)->links()!!}
    				@else
    					{!!$subpages->links()!!}
    				@endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
