<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            <input type="hidden" name="Id_Embarque" id="Id_Embarque" value={{$empresa}}>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                {{ Form::label('cantidad') }}
                {{ Form::text('cantidad', $anticipo->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'Cantidad']) }}
                {!! $errors->first('cantidad', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label>{{ __('Fecha del Anticipo') }}</label>
                <div>
                    <div class="form-group{{ $errors->has('Fecha_Anticipo') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('Fecha_Anticipo') ? ' is-invalid' : '' }}" name="Fecha_Anticipo" id="input-Fecha_Anticipo" type="date" placeholder="{{ __('Fecha_Anticipo') }}" value="{{ old('Fecha_Anticipo',$anticipo->Fecha_Anticipo) }}" required />
                        @if ($errors->has('Fecha_Anticipo'))
                        <span id="Fecha_Anticipo-error" class="error text-danger" for="input-Fecha_Anticipo">{{ $errors->first('Fecha_Anticipo') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>