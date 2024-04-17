@extends('layouts.app')

@section('template_title')
{{ $cliente->name ?? "{{ __('Show') Cliente" }}
@endsection

@section('content')
<section class="content container-fluid py-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">

                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-11">


                            <div class=" d-flex justify-content-center border-bottom border-4 border-primary mb-3
                            ml-4">
                                <p class="h3">Cliente: {{ $cliente->Nombre 
                                }}</p>
                                <br>


                            </div>
                            <strong>Direccion:</strong>
                            {{ $cliente->Direccion }}


                        </div>
                        <div class="col-md-1">
                            <div class="float-right">
                                <a class="btn btn-primary mb-2" href="{{ route('clientes.index') }}">
                                    {{ __('Regresar') }}</a>
                                <a class="btn btn-primary" a href="{{ route('imprimir',$cliente->id) }}">
                                    {{ __('Imprimir') }}</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-sm table-hover">
                            <thead class="thead">
                                <tr>
                                    <div
                                        class="d-flex justify-content-between border-bottom border-4 border-primary mb-3 ml-4">
                                        <p class="h4">Contactos</p>
                                        <div class="float-right">
                                            <a href="{{ route('contacto',$cliente->id) }}"
                                                class="btn btn-primary btn-sm float-right" data-placement="left">
                                                {{ __('Agregar Contacto') }}
                                            </a>
                                        </div>

                                    </div>

                                </tr>
                                <tr>


                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactos as $contacto)
                                <tr>


                                    <td>{{ $contacto->Nombre }}</td>
                                    <td>{{ $contacto->Puesto }}</td>
                                    <td>{{ $contacto->Correo }}</td>
                                    <td>{{ $contacto->Telefono }}</td>


                                    <td>
                                        <form action="{{ route('contactos.destroy',$contacto->id) }}" method="POST">

                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('contactoe',[$contacto->id ,$cliente->id ])}}"><i
                                                    class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-4">
            <div class="card card-chart">
                <div class="card-header  d-flex justify-content-between">
                    <h5 class="card-category">Embarques </h5>
                    <h5 class="fw-bold">Total: {{$embarquest}}</h5>


                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        const ctx = document.getElementById('myChart');
        const cdata = JSON.parse('<?php echo $embarques; ?> ')

        let embarquesl = cdata.map(obj => obj.status);



        let embarques = cdata.map(obj => obj.total);
        console.log(embarques);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: embarquesl,
                datasets: [{
                    label: ['Embarques'],
                    data: embarques,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>
    </div>
</section>
@endsection