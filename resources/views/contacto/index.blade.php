@extends('layouts.app')

@section('template_title')
Contacto
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Contacto') }}
                        </span>


                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="Table" class="table table-striped table-sm table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Correo</th>
                                    <th>Empresa</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactos as $contacto)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $contacto->Nombre }}</td>
                                    <td>{{ $contacto->Puesto }}</td>
                                    <td>{{ $contacto->Correo }}</td>
                                    <td>{{ $contacto->cliente->Nombre }}</td>

                                    <td>
                                        <form action="{{ route('contactos.destroy',$contacto->id) }}" class="formEliminar" method="POST">


                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" class=""><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $contactos->links() !!}
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
                            title: 'Eliminar Contacto',
                            text: "Esta seguro de eliminar el contacto seleccionado!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, borrar contacto!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.submit();
                                Swal.fire(
                                    'Borrado!',
                                    'El contacto ha sido borrado exitosamente.',
                                    'success'
                                )
                            }
                        })
                    }, false)
                })
        })()
    </script>

</div>
@endsection