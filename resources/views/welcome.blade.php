<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
</head>
<body>
    <form method="post" action="/info">
        @csrf
        <label for="from">From:
            <input type="date" id="from" name="from" value="">
        </label>
        <label for="to">To:
            <input type="date" id="to" name="to">
            <input type="submit" name="Render">
        </label>
    </form>
    <br>
@if(!empty($body['msg']))
    <h1>{{$body['msg']}}</h1>
@else
    <canvas id="myChart" height="75%"></canvas>
    <script>
        console.log(JSON.parse(@json($body)))
        const now = new Date();
        const today = now.toISOString().slice(0, 10);
        const tenDaysBefore = new Date(now.setDate(now.getDate() - 10)).toISOString().slice(0, 10);
        document.getElementById("from").defaultValue = tenDaysBefore;
        document.getElementById("to").defaultValue = today;
        const ctx = document.getElementById('myChart');
        const bCoinRates = JSON.parse(@json($body)).bpi;
        const values = [];
        for(const item of Object.keys(bCoinRates)){
            values.push(bCoinRates[item]);
        }
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: Object.keys(bCoinRates),
                datasets: [{
                    label: 'Bitcoin Rate',
                    data: values,
                    fill: false,
                    lineTension: 0,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
    </script>
@endif
</body>
</html>
