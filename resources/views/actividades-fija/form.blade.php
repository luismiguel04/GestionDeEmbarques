<div class="box box-info padding-1">
    <div class="box-body">
        <div class="col-sm-12">

            <div class="form-group">
                {{ Form::label('Nombre') }}
                {{ Form::text('Nombre', $actividadesFija->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>{{ __('Dias con respecto al Arranque') }}</label>
                <div>
                    <div class="form-group{{ $errors->has('Fecha_estimada') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('Fecha_estimada') ? ' is-invalid' : '' }}"
                            name="Fecha_estimada" id="input-Fecha_estimada" type="number"
                            placeholder="{{ __('Dias con respecto al Arranque') }}"
                            value="{{ old('Fecha_estimada',$actividadesFija->Fecha_estimada) }}" min="0" max=15
                            required />
                        @if ($errors->has('Fecha_estimada'))
                        <span id="Fecha_estimada-error" class="error text-danger"
                            for="input-Fecha_estimada">{{ $errors->first('Fecha_estimada') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">


            {{ Form::label('servicio al que pertenece') }}
            <select name="servicios_id" id="servicios_id" class="form-select" required>
                <option selected disabled value="">Seleccionar servicio</option>
                @foreach ($servicios as $item)
                @if($actividadesFija->servicios_id=== $item->id)
                <option value="{{ $item->id }}" selected>
                    {{ $item->Nombre }}
                </option>
                @else
                <option value="{{ $item->id }}">
                    {{ $item->Nombre }}
                </option>
                @endif
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please select a valid state.
            </div>

        </div>

    </div>
    <div class="box-footer mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>

</div>