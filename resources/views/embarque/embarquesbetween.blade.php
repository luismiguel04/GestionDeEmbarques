<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

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
                Embarques creados entre {{$fechainicio}} y {{$fechafin}}

            </h5>

        </div>
        <br>
    </span>



    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                <div class="table-responsive ">


                    <table class=" table table table-bordered table-striped table-sm">
                        <thead class=" thead">
                            <tr>

                                <th>No</th>
                                <th>{{ __('Referencia') }}</th>
                                <th>{{ __('Cliente') }}</th>
                                <th>{{ __('Encargado') }}</th>
                                <th>{{__('Fecha')}}</th>
                                <th>Status</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($embarques as $embarque)

                            <tr>

                                <td>{{ ++$i }}</td>

                                <td>{{ $embarque->Referencia }}</td>
                                <td>{{ $embarque->cliente->Nombre }}</td>
                                <td>{{ $embarque->User->name }}</td>
                                <td>{{ $embarque->ETA }}</td>
                                <td>{{ $embarque->Status }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th COLSPAN="6" scope="row" style="text-align:center;"> Total de embarques {{$total}}
                                </th>


                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>


</body>