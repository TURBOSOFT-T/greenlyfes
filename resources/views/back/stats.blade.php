


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Gráfico de Nuevos Usuarios</title>
</head>
<body>

    <div id="container" style="width:100%; height:400px;"></div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var userData = <?php echo json_encode($userData); ?>;
        
        Highcharts.chart('container', {
            title: {
                text: 'Nouvels Utilisateurs en <?php echo date('Y'); ?>'
            },
            subtitle: {
                text: 'Croissance des Utilisateurs au Cours de l\'Année'
            },
            xAxis: {
                categories: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                    'Octobre', 'Novembre', 'Décembre']
            },
            yAxis: {
                title: {
                    text: 'Nombre de Nouvels Utilisateurs'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Nouvels Utilisateurs',
                data: userData
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
</body>
</html>
