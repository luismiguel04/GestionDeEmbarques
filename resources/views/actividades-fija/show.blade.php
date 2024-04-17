@extends('layouts.app')

@section('template_title')
{{ $actividadesFija->name ?? "{{ __('Show') Actividades Fija" }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} {{ __('Actividades Fijas') }}</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('actividades-fijas.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>{{ __('Nombre') }}:</strong>
                        {{ $actividadesFija->Nombre }}
                    </div>
                    <div class="form-group">
                        <strong>{{ __('Fecha Estimada') }}:</strong>
                        {{ $actividadesFija->Fecha_estimada }}
                    </div>
                    <div class="form-group">
                        <strong>{{ __('Servicios al que pertenece') }}::</strong>
                        <td>{{ $actividadesFija->servicio->Nombre }}</td>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection