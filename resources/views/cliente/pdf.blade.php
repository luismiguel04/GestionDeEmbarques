<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        body {
            margin-right: 2rem;
            font-family: helvetica-bold;
            text-decoration: solid;

        }
    </style>

</head>

<body>
    <span id="card_title">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <img width="200px" src="http://localhost/GestionDeEmbarques/storage/app/public/Logo.png" />
        </div>
        <br>
    </span>


    <section class="content container-fluid py-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">

                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-11">


                                <div class=" d-flex justify-content-center  border-4 border-primary mb-3
                            ">
                                    <p class="h3">Cliente: {{ $cliente->Nombre 
                                }}</p>
                                    <br>


                                </div>
                                <strong>Direccion:</strong>
                                {{ $cliente->Direccion }}


                            </div>
                            <div class="col-md-1">


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
                                        <div class="d-flex justify-content-between border-bottom border-4 border-primary mb-3 ml-4">
                                            <p class="h4">Contactos</p>
                                        </div>

                                    </tr>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactos as $contacto)
                                    <tr>
                                        <td>{{ $contacto->Nombre }}</td>
                                        <td>{{ $contacto->Puesto }}</td>
                                        <td>{{ $contacto->Correo }}</td>
                                        <td>{{ $contacto->Telefono }}</td>

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
</body>