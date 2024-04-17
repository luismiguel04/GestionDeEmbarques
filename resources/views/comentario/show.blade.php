@extends('layouts.app')

@section('template_title')
    {{ $comentario->name ?? "{{ __('Show') Comentario" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Comentario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('comentarios.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Actividad:</strong>
                            {{ $comentario->Id_Actividad }}
                        </div>
                        <div class="form-group">
                            <strong>Id User:</strong>
                            {{ $comentario->Id_User }}
                        </div>
                        <div class="form-group">
                            <strong>Comentario:</strong>
                            {{ $comentario->Comentario }}
                        </div>
                        <div class="form-group">
                            <strong>Documento Path:</strong>
                            {{ $comentario->Documento_path }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
