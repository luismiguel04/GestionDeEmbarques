@extends('layouts.app')

@section('template_title')
{{ __('Create') }} Actividades Fija
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Create') }} Actividades Fija</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('actividades-fijas.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('actividades-fija.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection