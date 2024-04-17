@extends('layouts.app')

@section('template_title')
{{ __('Create') }} Embarque
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="col-sm-12">
                <form method="post" action="{{ route('embarquesporfecha') }}" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-2">

                        <input type="text" class="form-control" aria-label="Text input with input" value="Reporte de embarques por fecha" disabled readonly>
                        <input type="date" placeholder="fecha de inicio " name="fechainicio" id="fechainicio">
                        <input type="date" placeholder="fecha final" name="fechafin" id="fechafin">
                        <button class="btn btn-outline-primary" type="submit">
                            Generar
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <form method="post" action="{{ route('embarquesporfechac') }}" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-2">


                        <input type="text" class="form-control" aria-label="Text input with input" value="Reporte de embarques por fecha" disabled readonly>

                        <select name="cliente" id="cliente" class="form-select" required>
                            <option value=''>Seleccione un cliente</option>
                            @foreach ($clientes as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->Nombre }}
                            </option>

                            @endforeach
                        </select>
                        <input type="date" placeholder="fecha de inicio " name="fechainicio" id="fechainicio">
                        <input type="date" placeholder="fecha final" name="fechafin" id="fechafin">
                        <button class="btn btn-outline-primary" type="submit">
                            Generar
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <form method="post" action="{{ route('reportependientes') }}" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-2">


                        <input type="text" class="form-control" aria-label="Text input with input" value="Reporte de Pendientes" disabled readonly>

                        <select name="embarque" id="embarque" class="form-select" required>
                            <option value=''>Seleccione un embarque</option>
                            @foreach ($embarquesp as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->Referencia }} - {{ $item->Cliente->Nombre }}
                            </option>

                            @endforeach
                        </select>

                        <button class="btn btn-outline-primary" type="submit">
                            Generar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection