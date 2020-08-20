@extends('adminlte::page')

@section('title', 'Admin - Produtos')

@section('content_header')
    <h1>Produtos</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin.home')}}" title="dashboard">Dashboard</a>
        </li>
        <li>
            <a href="{{route('products.index')}}" title="products" class="active">Produtos</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				<form action="{{route('products.search')}}" method="post" class="form-inline">
    					@csrf
                        <select class="form-control" id="category" name="category">
                            <option value="">Categoria</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    @if($filters['category'] ?? false)
                                        @if($category->id == $filters['category'])
                                            selected
                                        @endif
                                    @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
    					<input type="text" name="item" id="item" placeholder="Texto" class="form-control" value="{{$filters['item'] ?? ''}}">
    					<input type="number" name="price" id="price" placeholder="Preço" class="form-control" value="{{$filters['price'] ?? ''}}">
    					<button type="submit" class="btn btn-default">Buscar</button>
    				</form>

    				@if(isset($filters))
    					<a href="{{route('products.index')}}" title="clear">(X) Limpar resultados da pesquisa</a>
    				@endif
    			</div>
    		</div>
    		<div class="box box-success">
    			<div class="box-body">
                    @include('admin.includes.alerts')
    				<span class="pull-right"><a class="btn btn-primary" href="{{route('products.create')}}" title="create">Adicionar</a></span>
    				<table class="table table-striped">
    					<thead>
    						<tr>
    							<th>#</th>
                                <th>Categoria</th>
    							<th>Título</th>
    							<th>Preço</th>
                                <th>Ações</th>
    						</tr>
    					</thead>
    					<tbody>
    						@foreach($products as $product)
    							<tr>
    								<td>{{$product->id}}</td>
    								<td>{{$product->category->title}}</td>
                                    <td>{{$product->name}}</td>
    								<td>{{$product->price}}</td>
    								<td>
    									<a href="{{route('products.edit', $product->id)}}" title="edit" class="badge bg-yellow">
    										Editar
    									</a>
    									<a href="{{route('products.show', $product->id)}}" title="show" class="badge bg-blue">
    										Visualizar
    									</a>
    								</td>
    							</tr>
    						@endforeach
    					</tbody>
    				</table>
    				@if(isset($filters))
    					{!!$products->appends($filters)->links()!!}
    				@else
    					{!!$products->links()!!}
    				@endif
    			</div>
    		</div>
    	</div>
    </div>
@stop
