@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$image->name ?? old('name')}}" placeholder="Nome">
</div>
<div class="form-group">
    <label for="path">Imagem</label>
    <input type="file" class="form-control" id="path" name="path" accept="image/*" />
</div>
<button type="submit" class="btn btn-success">Salvar</button>
<br><hr>
@if($image && $image->path)
<p>
    <img src="{{$image->path_url}}" alt="{{$image->name}}" class="img-fluid">
</p>
@endif