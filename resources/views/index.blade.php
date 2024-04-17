@extends('layouts.app')

@section('template_title')
Embarque
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-3 p-3">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="col-sm-6 text-left">
                                    <h5 class="card-category">{{ __('Embarques') }}</h5>

                                </div>
                                <div class="col-sm-1 ">
                                    <h5 class="card-category">{{$embarquest }}</h5>

                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 p-3">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h5 class="card-category">{{ __('Embarques') }}</h5>
                                <select class="form-control" id="schar2">
                                    @foreach ($embarques as $embarque)

                                    <option id="{{$embarque->id}}">{{$embarque->status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 p-3">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h5 class="card-category">{{ __('Embarques') }}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 p-3">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h5 class="card-category">{{ __('Embarques') }}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 p-3">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h5 class="card-category">{{ __('Embarques') }}</h5>
                                <select id="schart1" name="schart1">
                                    <option value="vol">Volumen</option>
                                    <option value="prix">Prix</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 p-3">
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <h5 class="card-category">{{ __('Embarques') }}</h5>
                                <select id="selectOption">

                                </select>
                            </div>

                        </div>
                        <div class="card-body">
                            <div>
                                <canvas id="myChart5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>







        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            //selecionar chart
            const ctx = document.getElementById('myChart');
            const ctx1 = document.getElementById('myChart1');
            const ctx2 = document.getElementById('myChart2');
            const ctx3 = document.getElementById('myChart3');
            const ctx4 = document.getElementById('myChart4');
            const ctx5 = document.getElementById('myChart5');
            //recuperar datos de el controlardor
            const embarquesa = JSON.parse('<?php echo $embarques; ?> ')

            let embarquesl = embarquesa.map(obj => obj.status);
            let embarques = embarquesa.map(obj => obj.total);


            //opciones por default
            const generarcolores = opacity => {

                const colores = ['#7600a9', '#8a16bd', '#a80083', '#be1a95', '#2700b31'];
                return colores.map(color => opacity ? '$ {color + opacity}' : color)
            }
            const generarColoresv = (opacity = 1) => {

                const colores = ['#7748c2', '#21c0d7', '#d99e2b', '#cd3a81', '#9c99cc', '#e14eca', '#fffff',
                    '#ff6f61 ',
                    '#ff8c78',
                    '#ffb07c', '#ffca92', '#ffdcb1', '#ffd500', '#ffed70',
                    '#ffdb58'
                ];
                return colores.map(color =>
                    `rgba(${parseInt(color.slice(1, 3), 16)}, ${parseInt(color.slice(3, 5), 16)}, ${parseInt(color.slice(5, 7), 16)}, ${opacity})`
                );
            }




            //cracion de charts
            const primerchar = () => {
                const data = {
                    labels: embarquesl,
                    datasets: [{
                        label: ['Embarques'],
                        data: embarques,
                        borderColor: generarColoresv(),
                        backgroundColor: generarColoresv(0.5),
                        borderWidth: 1
                    }]
                }
                const options = {
                    scales: {

                    },
                    plugins: {
                        legend: {
                            position: 'left'
                        }
                    }
                }
                new Chart(ctx, {
                    type: 'doughnut',
                    data,
                    options
                });
            }
            const segundochar = () => {
                const data = {
                    labels: embarquesl,
                    datasets: [{
                        label: ['Embarques'],
                        data: embarques,
                        borderWidth: 1
                    }]
                }
                const options = {
                    scales: {

                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
                new Chart(ctx1, {
                    type: 'bar',
                    data,
                    options
                });
            }
            const tercerchar = () => {
                const data = {
                    labels: embarquesl,
                    datasets: [{
                        label: ['Embarques'],
                        data: embarques,
                        tension: 0,
                        fill: true,
                        borderWidth: 1,
                        pointRadius: 6
                    }]
                }
                const options = {
                    scales: {

                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
                new Chart(ctx2, {
                    type: 'line',
                    data,
                    options
                });
            }

            const cuartochar = () => {
                const data = {
                    labels: embarquesl,
                    datasets: [{
                        label: ['Embarques'],
                        data: embarques,
                        borderWidth: 1
                    }]
                }
                const options = {
                    scales: {

                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
                new Chart(ctx3, {
                    type: 'pie',
                    data,
                    options
                });
            }
            const cintochar = () => {



                const data = {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                    datasets: [{
                        label: 'Volumen',
                        data: [50, 75, 25, 100, 200, 150],
                        backgroundColor: 'rgba(75, 192, 192, 0.4)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };


                const options = {
                    scales: {

                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
                new Chart(ctx4, {
                    type: 'polarArea',
                    data,
                    options
                });
            }
            const sextochar = () => {
                const data = {
                    labels: embarquesl,
                    datasets: [{
                        label: ['Embarques'],
                        data: embarques,
                        borderWidth: 1
                    }]
                }
                const options = {
                    scales: {

                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
                new Chart(ctx5, {
                    type: 'radar',
                    data,
                    options
                });
            }

            const Mostrarcharts = () => {
                primerchar()
                segundochar()
                tercerchar()
                cuartochar()
                cintochar()
                sextochar()
            }
            Mostrarcharts()
            // Función para cargar datos del gráfico al cambiar el select
            document.getElementById('schar2').addEventListener('change', function() {
                var selectedValue = this.value;
                updateChart(selectedValue);
            });


            const embarquesn = JSON.parse('<?php echo $chartData; ?> ')

            let embarques2 = embarquesn.map(obj => obj.status);
            let embarques3 = embarquesn.map(obj => obj.total);

            // Función para actualizar el gráfico
            function updateChart(data) {



                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: embarques2,
                        datasets: [{
                            label: 'Datos del Gráfico',
                            data: embarques3,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
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
            }

            // Carga los datos del gráfico al cargar la página
            fetchData('Completada');



            // actualizar filtro chart

            /*   actualizarchartartartchart = (charid, data, label) => {
                  const chart = Chart.getchart(charid)
                  chart.data.datasets[0].data = data
                  chart.data.datasets[0].label = label
                  chart.update()
              } */

            /*    document.querySelector('#schart').onchange = e => {
                   const {
                       value: property,
                       text: label
                   } = e.target.seletedOptions[0]
                   const newData = embarquesl.map(obj => obj[property])

                   actualizarchar('mychart2', newData, label)
               } */
            /* document.querySelector('#schart').onchange = e => {
                const {
                    value: property,
                    text: label
                } = e.target.seletedOptions[0]

                mychart2.data.datasets[0].label = label;
                mychart2.data.datasets[0].data = embarquesl.map(obj => obj[property]);
                mychart2.update();
            } */
            document.querySelector('#schart1').onchange = e => {
                const {
                    value: property,
                    text: label
                } = e.target.seletedOptions[0]

                ctx4.data.datasets[0].label = label;
                ctx4.data.datasets[0].data = embarquesl.map(obj => obj[property]);
                ctx4.update();
            }
        </script>


    </div>
</div>
@endsection