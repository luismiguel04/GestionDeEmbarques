@extends('layouts.app')

@section('template_title')
{{ __('Update') }} Actividad Embarque
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-8">


            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Update') }} Actividad Embarque</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('actividadembarques.update', $actividadembarque->id) }}"
                        role="form" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('actividadembarque.form')

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection