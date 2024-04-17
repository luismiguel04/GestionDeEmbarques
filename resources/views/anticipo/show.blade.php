@extends('layouts.app')

@section('template_title')
    {{ $anticipo->name ?? "{{ __('Show') Anticipo" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Anticipo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('anticipos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Embarque:</strong>
                            {{ $anticipo->Id_Embarque }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $anticipo->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Anticipo:</strong>
                            {{ $anticipo->Fecha_Anticipo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
