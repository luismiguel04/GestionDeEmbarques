@extends('layouts.app')

@section('template_title')
{{ $embarque->name ?? "{{ __('Show') Embarque" }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <script type="text/javascript">
            setTimeout(function() {
                document.querySelector('.alert').style.display = 'none';
            }, 1500); // 5000 milisegundos = 5 segundos
            </script>


            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <strong class="text-primary fw-bold fs-5">{{ __('Referencia') }}</strong>
                                        <br>
                                        {{ $embarque->Referencia }}
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <strong class="text-primary fw-bold fs-5">{{ __('Cliente') }}</strong>
                                        <br>
                                        {{ $embarque->Cliente->Nombre }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <strong class="text-primary fw-bold fs-5">{{ __('Encargado') }}</strong>
                                        <br>
                                        {{ $embarque->User->name }}
                                    </div>
                                </div>
                                <div class="col-md-2">

                                    <div class="form-group">
                                        <strong class="text-primary fw-bold fs-5">{{ __('Fecha de arranque') }}</strong>
                                        <br>

                                        {{ \Carbon\Carbon::parse($embarque->ETA)->format('d/m/Y')}}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <strong class="text-primary fw-bold fs-5">Status</strong>
                                        <br>
                                        {{ $embarque->Status }}
                                    </div>
                                </div>


                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 " style="height: 400px; overflow-x: auto;">
                                    <table id="Table"
                                        class="table table-sm table-hover  border-primary overflow: auto;">
                                        <thead class="thead">
                                            <tr>

                                                <th>{{ __('Actividad') }}</th>
                                                <th>{{ __('Encargado') }}</th>

                                                <th>Status</th>
                                                <th>{{ __('Fecha Estimada') }}</th>
                                                <th>{{ __('Tiempos') }}</th>
                                                <th>{{ __('ESTATUS TIEMPO') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($actividadembarques as $actividad)
                                            @php
                                            $clase = ($actividad->tiempo == "En Tiempo") ? "" :
                                            "table-danger";
                                            $estadoOptions = ['En Proceso', 'Completada'];
                                            @endphp
                                            <tr class="{{ $clase }}">
                                                <td>{{ $actividad->ActividadesFija->Nombre }}</td>
                                                <td>{{ $actividad->User->name }}</td>
                                                <td>{{ $actividad->A_Status }}</td>
                                                <td>{{ $actividad->fecha_act }}</td>
                                                <td>{{ $actividad->retraso }}</td>
                                                <td>
                                                    <p
                                                        class="text-left font-weight-bold {{ $actividad->tiempo == 'En Tiempo' ? 'text-primary' : 'text-danger' }}">
                                                        {{ $actividad->tiempo }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('actividadembarques.edit',$actividad->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i>Editar</a>
                                                    <a type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#vistaprevia{{ $actividad->id }}">
                                                        <i class="fa fa-fw fa-plus"></i>
                                                    </a>
                                                    <!-- Modal Code Here -->
                                                    <div class="modal fade" id="vistaprevia{{$actividad->id}}"
                                                        tabindex="-1" aria-labelledby="vistaprevia" aria-hidden="true">
                                                        <div class="modal-dialog modal-fullscreen-sm-down">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="box box-info padding-1">
                                                                        <div class="box-body">
                                                                            <div class="form-group">
                                                                                <form method="POST"
                                                                                    action="{{ route('comentarios.store') }}"
                                                                                    role="form"
                                                                                    enctype="multipart/form-data">
                                                                                    @csrf

                                                                                    @include('comentario.form')

                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>


                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <strong class="text-primary fw-bold fs-5">{{ __('Servicios') }}</strong>
                            <br>
                            @foreach ($serviciosembarque as $item)

                            <i class="fas fa-fw fa-snowflake fa-lg  text-success"></i>
                            <label for="check">{{$item->Nombre}}</label>
                            <br>
                            @endforeach
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-hover">
                                    <thead class="thead">

                                        <td>Fecha</td>
                                        <td>Monto</td>
                                        <td> Anticipo</td>
                                    </thead>
                                    <tbody>
                                        @foreach ($anticipos as $anticipo)
                                        <tr>
                                            <td>{{ $anticipo->Fecha_Anticipo }}</td>
                                            <td>
                                                ${{ number_format($anticipo->cantidad, 2, ".", ",") }}
                                            </td>

                                            <td>
                                                <form action="{{ route('anticipos.destroy',$anticipo->id) }}"
                                                    method="POST">

                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('anticipoe',[$anticipo->id ,$embarque->id ])}}"><i
                                                            class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th>
                                            <slot>$</slot>{{ number_format($total, 2, ".", ",") }}
                                        </th>
                                    </tfoot>

                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-hover">
                                    <thead class="thead">

                                        <td>Fecha</td>
                                        <td>Monto</td>
                                        <td>Gastos</td>
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos as $pago)
                                        <tr>
                                            <td>{{ $pago->fecha }}</td>
                                            <td>
                                                ${{ number_format($pago->cantidad, 2, ".", ",") }}
                                            </td>

                                            <td>
                                                {{$pago->concepto}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>TOTAL</th>
                                        <th>
                                            <slot>$</slot>{{ number_format($totalpagos, 2, ".", ",") }}
                                        </th>
                                        <tr>
                                            <th>SALDO</th>
                                            <th>
                                                <slot>$</slot>{{ number_format($saldo, 2, ".", ",") }}
                                            </th>

                                        </tr>

                                    </tfoot>

                                </table>
                            </div>
                        </div>
                        <div class="col-md-1  ps-0 pe-0 justify-content-end">
                            <div class="float-right me-0 pe-0 ">
                                <a class="btn btn-primary" href="{{ route('embarques.index') }}">
                                    {{ __('Back') }}</a>
                            </div>
                            <div class="float-right  ps-0 ms-0 me-5">
                                <a class="btn btn-primary" href="{{ route('comentario.ver',$embarque->id)}}">
                                    {{ __('Comentarios') }}</a>

                            </div>
                            <div class="d-flex justify-content-between">

                                <div class="float-right">
                                    <a href="{{ route('anticipo',$embarque->id) }}"
                                        class="btn btn-primary btn-sm float-right" data-placement="left">
                                        {{ __('Anticipos') }}
                                    </a>
                                </div>

                            </div>
                        </div>



                    </div>


                </div>
            </div>
        </div>
        <script>
        $('#Table').DataTable({
            language: {
                "lengthMenu": "Mostrar   _MENU_   registros ",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
            "lengthMenu": [
                [-1, 50, 10, 5, 2, 1],
                ["All", 50, 10, 5, 2, 1]
            ],
            dom: '<"top"lf>rt<"bottom"pi><"clear">',
            responsive: "true",
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success'
            }, ],
        });

        (function() {
            'use strict'
            var forms = document.querySelectorAll('.formEliminar')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {

                        event.preventDefault()
                        event.stopPropagation()
                        Swal.fire({
                            title: 'Eliminar becado',
                            text: "Esta seguro de eliminar el becado seleccionado para eliminarlo es necesario asegurarse que el becado no tenga ningun registro ya que afectara en la base de datos!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, borrar becado!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                                Swal.fire(
                                    'Borrado!',
                                    'El becado ha sido borrado exitosamente.',
                                    'success'
                                )
                            }
                        })
                    }, false)
                })
        })()
        </script>




    </div>

</section>
@endsection