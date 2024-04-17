@extends('layouts.app')

@section('template_title')
{{ __('Update') }} Actividades Fija
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Actividades Fija</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('actividades-fijas.update', $actividadesFija->id) }}" role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('actividades-fija.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection