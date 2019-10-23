@csrf
<div class="form-group">
    <label for="title">Título</label>
    <input type="text" class="form-control" id="title" name="title" value="{{$category->title ?? old('title')}}" placeholder="Título">
</div>
<div class="form-group">
    <label for="description">Descrição</label>
    <textarea class="form-control" id="description" name="description" placeholder="Descrição">{{$category->description ?? old('description')}}</textarea>
</div>
<button type="submit" class="btn btn-success">Salvar</button>