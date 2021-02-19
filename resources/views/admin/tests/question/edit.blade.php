@extends('adminlte::page')

@section('title', 'Admin - Questões da Prova')

@section('content_header')
    <h1>Editar Questão</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}" title="dashboard">Dashboard</a></li>
        <li><a href="{{route('tests.show', $test->id)}}" title="tests" class="active">Visualizar prova</a></li>
        <li><a href="{{route('tests.edit.question', ['test_id' => $test->id, 'id' => $question->id])}}" title="edit" class="active">Editar questão</a></li>
    </ol>
@stop

@section('content')
    <div class="content">
    	<div class="row">
    		<div class="box box-success">
    			<div class="box-body">
    				@include('admin.includes.alerts')
    				<form action="{{route('tests.update.question', ['test_id' => $test->id, 'id' => $question->id])}}" method="post">
    					@csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="enunciated">Enunciado</label>
                                    <textarea name="enunciated" id="enunciated" class="form-control">{{old('enunciated', $question->enunciated)}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="title">Questão</label>
                                    <textarea name="title" id="title" class="form-control">{{old('title', $question->title)}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="teaching_unit_id">Orderm</label>
                                    <input type="number" name="order" id="order" value="{{old('order', $question->order)}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-md-11 choice-container">
                                        <h3>Opções de resposta</h3>
                                        @foreach ($question->choices()->get() as $key => $item)
                                        <div class="row choice-inputs">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        Correta?
                                                        <select class="form-control" style="min-width: 80px;" name="choiceCorrect[]">
                                                            <option value="0" {{ ('0' == $item->correct) ? 'selected' : '' }}>Não</option>
                                                            <option value="1" {{ ('1' == $item->correct) ? 'selected' : '' }}>Sim</option>
                                                        </select>
                                                    </span>
                                                    <input type="text" class="form-control" name="choiceTitle[]" placeholder="Título da opção" value="{{$item->title}}" required>
                                                    <input type="number" class="form-control" name="choiceOrder[]" placeholder="Ordem" value="{{$item->order}}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 text-right">
                                                <button type="button" class="btn btn-danger remove-choice">X</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <a class="btn btn-primary add-choice">+</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-success">Salvar</button>
    				</form>
    			</div>
    		</div>            
    	</div>
    </div>
@stop

@section('adminlte_js')
    <script>
        $(function() {
            CKEDITOR.replace( 'enunciated' );
            CKEDITOR.replace( 'title' );

            // clone element
            $(document).on("click", ".add-choice", function(event) {
                $(".choice-container").append($(".choice-inputs").eq(0).clone().show());
            });

            // remove element by index
            $(document).on("click", ".remove-choice", function(event) {
                var length = $(".remove-choice").length;
                var index = $(".remove-choice").index(this);
                if (length > 1) {
                    $(".choice-inputs").eq(index).remove();
                }
            });
        });
    </script>
@endsection
