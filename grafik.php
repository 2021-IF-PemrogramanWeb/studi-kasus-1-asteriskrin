<?php
    include 'action/class/Interlock.php';
    $interlocks = new Interlock();
    $interlock_datas = $interlocks->getData();
    $interlock_stats = $interlocks->getReasonStats();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Page 1</title>
</head>
<body>
    <div class="d-flex flex-column p-4 content">
        <div class="d-flex">
            <img src="img/logo.png" class="flex-grow-0">
            <div class="flex-grow-1">
                <button class="btn btn-dark float-end">Tgl Hari ini</button>
            </div>
        </div>
        <div>
            <p class="text-center fw-bold">Trend of Reason</p>
            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script>
        var areaChartData = {
            labels  : [<?php for ($id = 1; $id <= 16; $id++) echo $id.','; ?>],
            datasets: [
            {
                label               : 'Reason',
                backgroundColor     : '#33ccff',
                borderColor         : 'rgba(210, 214, 222, 1)',
                pointRadius         : false,
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : [<?php foreach ($interlock_stats as $x) { echo $x.', '; } ?>]
            },
            ]
        };

        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var barChartData = $.extend(true, {}, areaChartData);
        var temp0 = areaChartData.datasets[0];
        barChartData.datasets[0] = temp0;

        var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
        };

        new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        });
    </script>
</body>
</html>