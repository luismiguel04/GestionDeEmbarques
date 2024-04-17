<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('Nombre', $contacto->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Puesto') }}
            {{ Form::text('Puesto', $contacto->Puesto, ['class' => 'form-control' . ($errors->has('Puesto') ? ' is-invalid' : ''), 'placeholder' => 'Puesto']) }}
            {!! $errors->first('Puesto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Correo') }}
            {{ Form::text('Correo', $contacto->Correo, ['class' => 'form-control' . ($errors->has('Correo') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
            {!! $errors->first('Correo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Telefono') }}
            {{ Form::text('Telefono', $contacto->Telefono, ['class' => 'form-control' . ($errors->has('Telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('Telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">

            <input type="hidden" name="Empresa" id="Empresa" value={{$empresa}}>
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>