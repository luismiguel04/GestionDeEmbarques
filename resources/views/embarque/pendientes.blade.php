<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
    body {
        margin-right: 3rem;
    }
    </style>

</head>

<body>
    <span id="card_title">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <img width="200px" src="http://localhost/GestionDeEmbarques/storage/app/public/Logo.png" />



            <h5 style="text-align: center">


            </h5>

        </div>
        <br>
    </span>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pendientes Referencia') }}
                                {{$embarquem->Referencia}} - {{$embarquem->Cliente->Nombre}}
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>


                                        <th>Actividad</th>
                                        <th>Encargado</th>
                                        <th>Status</th>
                                        <th>Comentarios</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actividadembarques as $actividadembarque)
                                    <tr>
                                        <td>{{ ++$i }}</td>


                                        <td>{{ $actividadembarque->actividadesFija->Nombre }}</td>
                                        <td>{{ $actividadembarque->User->name }}</td>
                                        <td>{{ $actividadembarque->A_Status }}</td>
                                        <td>
                                            @foreach ($comentarios as $comentario)

                                            @if ($actividadembarque->id == $comentario->Id_Actividad)
                                            <p>{{ $comentario->Comentario }} {{ $comentario->FComentario }}</p>
                                            @endif
                                            @endforeach
                                        </td>


                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>






</body>