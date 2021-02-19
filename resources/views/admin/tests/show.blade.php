@extends('adminlte::page')

@section('title', 'Admin - Provas')

@section('content_header')
    <h1>Visualizando Item: {{$test->title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('tests.index')}}" title="tests" class="active">Provas</a></li>
        <li><a href="{{route('tests.show', $test->id)}}" title="show" class="active">Visualizar</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="col-sm-12">
                <div class="box box-success">
                    <div class="box-body">
                        @include('admin.includes.alerts')
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>ID: </strong>{{$test->id}}</p>
                                <p><strong>Instituição: </strong>{{$test->institution->name}}</p>
                                <p><strong>Unidade: </strong>{{$test->teaching_unit->name}}</p>
                                <p><strong>Tipo de oferta: </strong>{{$test->offer_type->name}}</p>
                                <p><strong>Disciplina: </strong>{{$test->discipline->name}}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Estado: </strong>{{$test->state}}</p>
                                <p><strong>Cidade: </strong>{{$test->city}}</p>
                                <p><strong>Ano: </strong>{{$test->year}}</p>
                                <p><strong>Banca: </strong>{{$test->jury}}</p>
                                <p><strong>Assunto: </strong>{{$test->subject->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <form action="{{route('tests.destroy', $test->id)}}" method="post" onsubmit="return confirm('Tem certeza que deseja deletar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Deletar</button>
                                </form>
                            </div>
                            <div class="col-sm-10 text-right">
                                <a href="{{route('tests.edit', $test->id)}}" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
        @include('_includes.modal_delete')
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-success">
                    <div class="box-body">
                        <span class="pull-right"><a class="btn btn-primary" href="{{route('tests.create.question', ['test_id' => $test->id])}}" title="create">Adicionar questão</a></span>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título da questão</th>
                                    <th>Total de opções</th>
                                    <th>Ordem</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($test->questions()->get() as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{!! $item->title !!}</td>
                                        <td>{{$item->choices()->count()}}</td>
                                        <td>{{$item->order}}</td>
                                        <td>
                                            <a href="{{route('tests.edit.question', ['test_id' => $test->id, 'id' => $item->id])}}" title="edit" class="badge bg-yellow">
                                                Editar
                                            </a>
                                            <a href="{{ route('tests.destroy.question', ['test_id' => $test->id, 'id' => $item->id]) }}" class="badge bg-red show-confirm-modal">Deletar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('body').on('click', '.show-confirm-modal', function(event){
            event.preventDefault();

            var me = $(this),
              action = me.attr('href');

            $('#confirm-body form').attr('action', action);
            $('#confirm-modal').modal('show');
          });

          $('#confirm-remove-btn').click(function(event){
            event.preventDefault();

            var form = $('#confirm-body form'),
            url = form.attr('action');

            $.ajax({
              url: url,
              method: 'DELETE',
              data: form.serialize(),
              success: function(response) {
                if (response.data.status == 'success') {
                  $('#confirm-modal').modal('hide');
                  swal.fire({
                    position: 'center',
                    type: 'success',
                    title: "SUCESSO!",
                    text: response.data.message,
                    showConfirmButton: false,
                    timer: 1500
                  });
                  location.reload();
                } else {
                  $('#confirm-modal').modal('hide');
                  swal.fire({
                    position: 'center',
                    type: 'error',
                    title: "ERRO!",
                    text: response.data.message,
                    showConfirmButton: false,
                    timer: 2500
                  });
                }
              },
              error: function(xhr) {
                $('#confirm-modal').modal('hide');
                  swal.fire({
                    position: 'center',
                    type: 'error',
                    title: "ERRO!",
                    text: "Ocorreu um erro no servidor, tente novamente ou contacte o administrador.",
                    showConfirmButton: false,
                    timer: 2500
                  });
              }
            });
          });
    });
</script>
@endsection