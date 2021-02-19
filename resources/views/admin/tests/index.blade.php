@extends('adminlte::page')

@section('title', 'Admin - Provas')

@section('content_header')
    <h1>Provas</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.home')}}" title="dashboard">Dashboard</a>
        </li>
        <li>
            <a href="{{route('tests.index')}}" title="tests" class="active">Provas</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				<form action="{{route('tests.search')}}" method="post" class="form-inline">
    					@csrf
    					<input type="text" name="title" id="title" placeholder="Título" class="form-control" value="{{$filters['title'] ?? ''}}">
    					<button type="submit" class="btn btn-default">Buscar</button>
    				</form>

    				@if(isset($filters))
    					<a href="{{route('tests.index')}}" title="clear">(X) Limpar resultados da pesquisa</a>
    				@endif
    			</div>
    		</div>
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<span class="pull-right"><a class="btn btn-primary" href="{{route('tests.create')}}" title="create">Adicionar</a></span>
    				<table class="table table-striped">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th>Instituição</th>
                                <th>Unidade de ensino</th>
                                <th>Estado</th>
                                <th>Cidade/Município</th>
                                <th>Tipo de oferta</th>
                                <th>Disciplina</th>
                                <th>Ano</th>
                                <th>Assunto</th>
    							<th>Ações</th>
    						</tr>
    					</thead>
    					<tbody>
    						@foreach($tests as $item)
    							<tr>
    								<td>{{$item->id}}</td>
    								<td>{{$item->institution->name}}</td>
                                    <td>{{$item->teaching_unit->name}}</td>
                                    <td>{{$item->state}}</td>
                                    <td>{{$item->city}}</td>
                                    <td>{{$item->offer_type->name}}</td>
                                    <td>{{$item->discipline->name}}</td>
                                    <td>{{$item->year}}</td>
                                    <td>{{$item->subject->name}}</td>
    								<td>
    									<a href="{{route('tests.edit', $item->id)}}" title="edit" class="badge bg-yellow">
    										Editar
    									</a>
    									<a href="{{route('tests.show', $item->id)}}" title="show" class="badge bg-blue">
    										Visualizar
    									</a>
    								</td>
    							</tr>
    						@endforeach
    					</tbody>
    				</table>
    				@if(isset($filters))
    					{!!$tests->appends($filters)->links()!!}
    				@else
    					{!!$tests->links()!!}
    				@endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
