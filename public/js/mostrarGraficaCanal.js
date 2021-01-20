
function mostrarGraficaCanal(idGrafica, idCanal) {

    var ctx = document.getElementById(idGrafica).getContext('2d');
    let url = "http://laboratorio.test/canalJSON/" + idCanal

    $.getJSON(url, function (data) {
        console.log(data);

        let tiempo = data.map(value => value[0]);
        let valores = data.map(value => value[1]);

        var config = {
            type: 'line',
            data: {
                labels: tiempo,
                datasets: [{

                    label: "Valores del canal " +  idCanal,
                    borderColor: 'rgb(14,37,241)',
                    backgroundColor: 'white',
                    fill: true,
                    data: valores
                }]
            },
            options: {
                responsive: true,

                title:{
                    display: true,
                    text: "Canal " +  idCanal,
                },
                legend: {
                    position: "bottom",
                },
                scales: {
                    xAxes: [{
                        scaleLabel:{
                            display: true,
                            labelString: 'Tiempo'
                        },
                        ticks: {
                            display: true
                        }
                    }],

                    yAxes: [{
                        scaleLabel:{
                            display: true,
                            labelString: 'Datos'
                        },
                        ticks: {
                            display: true
                        }
                    }],
                }
            }
        };

        var grafica = new Chart(ctx, config);
    });
}
