<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">

            <div class="col-sm-2">
                <div class="form-group">
                    {{ Form::label('Referencia') }}
                    {{ Form::text('Referencia', $embarque->Referencia, ['class' => 'form-control' . ($errors->has('Referencia') ? ' is-invalid' : ''), 'placeholder' => 'Referencia']) }}
                    {!! $errors->first('Referencia', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>

            <div class="col-sm-4">
                {{ Form::label('Empresa') }}
                <select name="Empresa" id="Empresa" class="form-select" required>
                    <option selected disabled value="">Seleccionar Empresa</option>
                    @foreach ($clientes as $item)
                    @if($embarque->Empresa=== $item->id)
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

            <div class="col-sm-2">
                {{ Form::label('Encargado') }}
                <select name="Encargado" id="Encargado" class="form-select" required>
                    <option selected disabled value="">Seleccionar Encargado</option>
                    @foreach ($users as $User)
                    @if($embarque->Encargado=== $User->id)
                    <option value="{{ $User->id }}" selected>
                        {{ $User->name }}
                    </option>
                    @else
                    <option value="{{ $User->id }}">
                        {{ $User->name }}
                    </option>
                    @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Please select a valid state.
                </div>

            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label>{{ __('ETA') }}</label>
                    <div>
                        <div class="form-group{{ $errors->has('ETA') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('ETA') ? ' is-invalid' : '' }}" name="ETA" id="input-ETA" type="date" placeholder="{{ __('ETA') }}" value="{{ old('ETA',$embarque->ETA) }}" required />
                            @if ($errors->has('ETA'))
                            <span id="ETA-error" class="error text-danger" for="input-ETA">{{ $errors->first('ETA') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">

                <div class="form-group">
                    {{ Form::label('Status') }}
                    <select name="Status" id="Status" class="form-select" required>
                        @if(old('Status',$embarque->Status==''))
                        <option selected disabled value="">Seleccionar Status</option>
                        @else
                        <option value="{{old('Status',$embarque->Status)}}">{{$embarque->Status}} {{"selecionado"}}
                            @endif

                        <option value='1'>{{"En Proceso"}}</option>
                        <option value='2'>{{"Completada"}}</option>
                        <option value='3'>{{"Cancelada"}}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 p-4">
                @foreach ($actividadembarque as $item)
                <label for="check">{{$item->Nombre}}</label>
                <input type="checkbox" name="check" id="c{{$item->id}}" onchange="javascript:showContent({{$item->id}}, 'c{{$item->id}}')" checked />

                @endforeach

            </div>
            <!-- forumlario de servicios -->
            <div class="row">
                @foreach ($servicios as $servicio)
                <div id="{{$servicio->id}}" class="col-12" style="">
                    @foreach ($actividades as $item)
                    <div class="row">
                        @if ($item->servicios_id == $servicio->id)
                        <div class="col-sm-6 p-4">
                            <label for="check">{{$item->Nombre}}</label>
                            <input type="hidden" name="Id_Actividad[]" id="Id_Actividad" value="{{$item->id}}">
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                {{ Form::label('Status') }}
                                <select name="A_Status[]" id="A_Status" class="form-select">

                                    <option disabled value="">Seleccionar status</option>
                                    <option value='1'>{{"En Proceso"}}</option>
                                    <option value='2'>{{"Completada"}}</option>
                                    <option value='3'>{{"Cancelada"}}</option>
                                </select>
                            </div>

                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                @endforeach
            </div>

        </div>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div>
    <script type="text/javascript">
        function showContent(num, VAL) {
            element = document.getElementById(num);
            check = document.getElementById(VAL);

            selectElements = element.getElementsByTagName('select');
            inputElements = element.getElementsByTagName('input');




            if (check.checked) {
                element.style.display = 'block';
                for (var i = 0; i < selectElements.length; i++) {
                    selectElements[i].required = true;
                    inputElements[i].required = true;
                }


            } else {
                element.style.display = 'none';
                for (var i = 0; i < selectElements.length; i++) {
                    selectElements[i].required = false;
                    inputElements[i].required = false;
                }

            }
        }


        window.addEventListener("load", showContent);
    </script>


</div>