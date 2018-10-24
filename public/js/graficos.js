$(document).ready(function(){ 

    var canvas = document.getElementById('chart').getContext('2d');
    var grafico;

    $("#reportEncuest").click(function(){        
        var url = '/reporte/graficoPoll';
        $.ajax({
            type: "GET",
            url: url,
            data: {
                data : document.getElementById("pregunts").value
            },
            success: function (data) {
                $("#modalEncuesta").modal('hide');
                $('.modal-backdrop').remove(); 
                graficoBarras(data);
                //$('#tableReport').html("");             
            },            
            error: function()
            {
                console.log("error");
            }
        });
    });

    
    $('#reportGeneral').click(function () {
        graficoCircular();
    });


    $("#reportesFechas").submit(function (e) {
        e.preventDefault();
        var url = '/reporte/graficoFecha';
        $.ajax({
            type: "POST",
            url: url,
            data: $('#reportesFechas').serialize(),
            success: function (data) {
                console.log(data.data);
                $('#exampleModalCenter').modal('hide'); 
                $('.modal-backdrop').remove();              
                $('#tableReport').html(data.vista);
                graficoLineal(data.data);

            },            
            error: function()
            {
                console.log("error");
            }
        });
    });
    

    function graficoCircular () {
        var url = '/reporte/graficoGeneral';
        $.ajax({
            type: "GET",
            url: url,
            data: {
                data: "graficoGeneral",
            },
            success: function (data) {
                
                var datos = {
                    type: "pie",
                    data : {
                        datasets :[{
                            data : data.data,
                            backgroundColor: data.backgroundColor,
                        }],
                        labels : data.labels
                    },
                    options : {
                        responsive : true,
                        title: {
                            display: true,
                            text: 'Grafico de incidentes en general'
                        }
                    }
                };
            
                if (grafico) {
                    $('#tableReport').html("");
                    grafico.clear();
                    grafico.destroy();
                }
                grafico = new Chart(canvas, datos);
                
            },            
            error: function()
            {
                console.log("error");
                //TODO controlar los errores
            }
        });
    }


    function graficoLineal (data) {
        var datos = {
            type: "line",
            data : {
                datasets :[{
                    label: "Reporte por fechas",
                    data : data,
                    borderColor: "#FA5858"                    
                }],
                labels : [
                    "Pendientes",
                    "Completados",
                    "Vencidos",
                ]
            },
            options : {
                responsive : true,
                title: {
                    display: true,
                    text: 'Grafico de incidentes'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        };
                
        if (grafico) {
            grafico.clear();
            grafico.destroy();
        }

        grafico = new Chart(canvas, datos);

    }


    function graficoBarras (data) {
        var datos = {
            type: "bar",
            data : {
                datasets :[{
                    label: data.lbl,
                    data : data.data,
                    backgroundColor: data.backgroundColor,
                }],
                labels : data.labels
            },
            options : {
                responsive : true,
                title: {
                    display: true,
                    text: data.text
                },
                scales: {
                    xAxes: [{
                        display: true
                    }],
                    yAxes: [{
                        display: true,
                        ticks: { min: 0 }
                    }]
                }
            }
        };
                
        if (grafico) {
            $('#tableReport').html("");
            grafico.clear();
            grafico.destroy();
        }

        grafico = new Chart(canvas, datos);

    }
    
});