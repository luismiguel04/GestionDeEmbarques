@extends('layouts.app')

@section('template_title')
{{ $actividadembarque->name ?? "{{ __('Show') Actividadembarque" }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Actividadembarque</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('pendientes') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Id Embarque:</strong>
                        {{ $actividadembarque->Id_Embarque }}
                    </div>
                    <div class="form-group">
                        <strong>Id Actividad:</strong>
                        {{ $actividadembarque->Id_Actividad }}
                    </div>
                    <div class="form-group">
                        <strong>Id User:</strong>
                        {{ $actividadembarque->Id_User }}
                    </div>
                    <div class="form-group">
                        <strong>A Status:</strong>
                        {{ $actividadembarque->A_Status }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection