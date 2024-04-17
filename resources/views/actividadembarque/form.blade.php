<div class="box box-info padding-1">
    <div class="box-body">


        <div class="col-sm-4">
            <div class="form-group">

                <div>
                    <div class="form-group{{ $errors->has('Id_Embarque') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('Id_Embarque') ? ' is-invalid' : '' }}"
                            name="Id_Embarque" id="input-Id_Embarque" type="hidden"
                            placeholder="{{ __('Id_Embarque') }}"
                            value="{{ old('Id_Embarque',$actividadembarque->Id_Embarque) }}" required />
                        @if ($errors->has('Id_Embarque'))
                        <span id="Id_Embarque-error" class="error text-danger"
                            for="input-Id_Embarque">{{ $errors->first('Id_Embarque') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>



        <div class="col-sm-2">

            <div class="form-group">
                {{ Form::label('Status') }}
                <select name="A_Status" id="A_Status" class="form-select" required>
                    @if(old('A_Status',$actividadembarque->A_Status==''))
                    <option selected disabled value="">Seleccionar A_Status</option>
                    @else
                    <option value="{{old('A_Status',$actividadembarque->A_Status)}}">{{$actividadembarque->A_Status}}
                        {{"selecionado"}}
                        @endif

                    <option value='1'>{{"En Proceso"}}</option>
                    <option value='2'>{{"Completada"}}</option>
                    <option value='3'>{{"Cancelada"}}</option>
                </select>
            </div>
        </div>



    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>