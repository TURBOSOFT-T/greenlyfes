<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
   
</head>
<body>

    <div id="orderContainer" style="width:100%; height:400px;"></div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var orderData = <?php echo json_encode($orderData); ?>;
        
        Highcharts.chart('orderContainer', {
            title: {
                text: 'Nouvelles Commandes en <?php echo date('Y'); ?>'
            },
            subtitle: {
                text: 'Croissance des Commandes au Cours de l\'Année'
            },
            xAxis: {
                categories: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                    'Octobre', 'Novembre', 'Décembre']
            },
            yAxis: {
                title: {
                    text: 'Nombre de Nouvelles Commandes'
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
                name: 'Nouvelles Commandes',
                data: orderData
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
