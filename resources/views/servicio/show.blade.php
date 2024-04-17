@extends('layouts.app')

@section('template_title')
{{ $servicio->name ?? "{{ __('Show')"  }} {{ __('Servicios') }}

@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} {{ __('Servicio') }}</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('servicios.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>{{ __('Nombre') }}:</strong>
                        {{ $servicio->Nombre }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection