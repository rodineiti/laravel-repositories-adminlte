@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$institution->name ?? old('name')}}" placeholder="Nome">
</div>
<button type="submit" class="btn btn-success">Salvar</button>