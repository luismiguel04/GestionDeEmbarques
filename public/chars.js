
//selecionar chart
const ctx = document.getElementById('myChart');
const ctx1 = document.getElementById('myChart1');
const ctx2 = document.getElementById('myChart2');
const ctx3 = document.getElementById('myChart3');
const ctx4 = document.getElementById('myChart4');
const ctx5 = document.getElementById('myChart5');
//recuperar datos de el controlardor


let embarquesl = cdata.map(obj => obj.status);
let embarques = cdata.map(obj => obj.total);

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




new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: embarquesl,
        datasets: [{
            label: ['Embarques'],
            data: embarques,
            borderWidth: 1,
            pointRadius: 10,
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






const data2 = {
    labels: ['enero', 'febrero', 'marzo'],
    datasets: [{
        label: 'Triangles',
        data: embarques,
        fill: false,
        borderColor: ['blue', 'green', 'yellow'],
        backgroundColor: ['blue', 'green', 'yellow'],
        pointStyle: 'triangle',
        pointRadius: 6,
    },
    {
        label: 'Circles',
        data: embarques,
        fill: false,
        borderColor: ['blue', 'green', 'yellow'],
        backgroundColor: ['blue', 'green', 'yellow'],
        pointStyle: 'circle',
        pointRadius: 6,
    },
    {
        label: 'Stars',
        data: embarques,
        fill: false,
        borderColor: ['blue', 'green', 'yellow'],
        backgroundColor: ['blue', 'green', 'yellow'],
        pointStyle: 'star',
        pointRadius: 6,
    }
    ]
};
