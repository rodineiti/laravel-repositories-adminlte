@csrf
<div class="form-group">
    <label for="category_id">Categoria</label>
    <select class="form-control" id="category_id" name="category_id">
    	<option value="">Selecione</option>
    	@foreach($categories as $category)
			<option value="{{$category->id}}" 
				@if($product ?? false)
					@if($category->id == $product->category_id)
						selected
					@endif
				@endif>{{$category->title}}</option>
    	@endforeach
    </select>
</div>
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$product->name ?? old('name')}}" placeholder="Nome">
</div>
<div class="form-group">
    <label for="price">Preço</label>
    <input type="number" class="form-control" id="price" name="price" value="{{$product->price ?? old('price')}}" placeholder="Preço">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea class="form-control" id="description" name="description" placeholder="Descrição">{{$product->description ?? old('description')}}</textarea>
</div>
<button type="submit" class="btn btn-success">Salvar</button>