@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="subject_id">Assunto</label>
            <select class="form-control" id="subject_id" name="subject_id">
                <option value="">Selecione</option>
                @foreach($subjects as $subject)
                    <option value="{{$subject->id}}" 
                        @if($test ?? false)
                            @if($subject->id == $test->subject_id)
                                selected
                            @endif
                        @endif>{{$subject->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="institution_id">Instituição</label>
            <select class="form-control" id="institution_id" name="institution_id">
                <option value="">Selecione</option>
                @foreach($institutions as $institution)
                    <option value="{{$institution->id}}" 
                        @if($test ?? false)
                            @if($institution->id == $test->institution_id)
                                selected
                            @endif
                        @endif>{{$institution->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="teaching_unit_id">Unidade de ensino</label>
            <select class="form-control" id="teaching_unit_id" name="teaching_unit_id">
                <option value="">Selecione</option>
                @foreach($teaching_units as $teaching_unit)
                    <option value="{{$teaching_unit->id}}" 
                        @if($test ?? false)
                            @if($teaching_unit->id == $test->teaching_unit_id)
                                selected
                            @endif
                        @endif>{{$teaching_unit->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="offer_type_id">Tipo de oferta</label>
            <select class="form-control" id="offer_type_id" name="offer_type_id">
                <option value="">Selecione</option>
                @foreach($offer_types as $offer_type)
                    <option value="{{$offer_type->id}}" 
                        @if($test ?? false)
                            @if($offer_type->id == $test->offer_type_id)
                                selected
                            @endif
                        @endif>{{$offer_type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="discipline_id">Disciplina</label>
            <select class="form-control" id="discipline_id" name="discipline_id">
                <option value="">Selecione</option>
                @foreach($disciplines as $discipline)
                    <option value="{{$discipline->id}}" 
                        @if($test ?? false)
                            @if($discipline->id == $test->discipline_id)
                                selected
                            @endif
                        @endif>{{$discipline->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="state">Estado</label>
            <select class="form-control" id="state" name="state">
                <option value="">Selecione</option>
                <option value="RS" 
                    @if($test ?? false)
                        @if($test->state == "RS")
                            selected
                        @endif
                    @endif>Rio Grande do Sul</option>
                <option value="SP" 
                    @if($test ?? false)
                        @if($test->state == "SP")
                            selected
                        @endif
                    @endif>São Paulo</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="city">Cidade/Município</label>
            <input type="text" class="form-control" id="city" name="city" value="{{$test->city ?? old('city')}}" placeholder="Cidade/Município">
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="year">Ano</label>
            <select class="form-control" id="year" name="year">
                <option value="">Selecione</option>
                <option value="2019"
                    @if($test ?? false)
                        @if($test->year == "2019")
                            selected
                        @endif
                    @endif>2019</option>
                <option value="2020"
                    @if($test ?? false)
                        @if($test->year == "2020")
                            selected
                        @endif
                    @endif>2020</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="jury">Banca</label>
            <input type="text" class="form-control" id="jury" name="jury" value="{{$test->jury ?? old('jury')}}" placeholder="Banca">
        </div>
    </div>
</div>
<button type="submit" class="btn btn-success">Salvar</button>