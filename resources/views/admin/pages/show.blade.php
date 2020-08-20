@extends('adminlte::page')

@section('title', 'Admin - Páginas')

@section('content_header')
    <h1>Visualizando Página: {{$page->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('pages.index')}}" title="pages" class="active">Páginas</a></li>
        <li><a href="{{route('pages.show', $page->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<p><strong>ID: </strong>{{$page->id}}</p>
    				<p><strong>Título: </strong>{{$page->title}}</p>
    				<p>
                        {!! $page->body !!}
                    </p>
    				<hr>
                    @if(auth()->id() !== $page->id)
    				<form action="{{route('pages.destroy', $page->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
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
