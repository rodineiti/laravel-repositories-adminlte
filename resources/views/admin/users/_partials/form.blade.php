@csrf
<div class="form-group">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{$user->name ?? old('name')}}" placeholder="Nome">
</div>
<div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" id="email" name="email" value="{{$user->email ?? old('email')}}" placeholder="E-mail">
</div>
<div class="form-group">
    <label for="admin">Administrador</label>
    <select class="form-control" id="admin" name="admin">
        <option value="0" {{isset($user) && $user->admin === "0" ? "selected" : ""}}>Não</option>
        <option value="1" {{isset($user) && $user->admin === "1" ? "selected" : ""}}>Sim</option>
    </select>
</div>
<hr>
<div class="form-group">
    <label for="password">Senha</label>
    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Senha">
</div>
<div class="form-group">
    <label for="password_confirmation">Confirmar senha</label>
    <input type="password" class="form-control" id="password_confirmation" value="" name="password_confirmation" placeholder="Confirmar senha">
</div>
<button type="submit" class="btn btn-success">Salvar</button>
