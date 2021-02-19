@csrf
<div class="form-group">
    <label for="name">Nome do assunto</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$subject->name ?? old('name')}}" placeholder="Nome do assunto">
</div>
<button type="submit" class="btn btn-success">Salvar</button>