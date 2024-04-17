@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Anticipo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Anticipo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('anticipos.update', $anticipo->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('anticipo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
