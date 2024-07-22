<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูลผู้สูงอายุ</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            padding: 10mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10mm;
            page-break-after: always;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        .charts {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            page-break-before: always;
        }

        .chart-container {
            width: 45%;
            height: 300px;
            margin-bottom: 10mm;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>รายงานข้อมูลผู้สูงอายุ</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>รูป</th>
                    <th>ชื่อ</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                </tr>
            </thead>
            <tbody>
                @foreach($elderlies as $elderly)
                <tr>
                    <td>
                        @if($elderly->Image_Elderly)
                            <img src="{{ asset('storage/'.$elderly->Image_Elderly) }}" alt="Elderly Image" width="50">
                        @else
                            <img src="{{ asset('storage/default.png') }}" alt="Elderly Image" width="50">
                        @endif
                    </td>
                    <td>{{ $elderly->Name_Elderly }}</td>
                    <td>{{ $elderly->Address }}</td>
                    <td>{{ $elderly->Phone_Elderly }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="charts">
            <div class="chart-container">
                <canvas id="ageBarChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="agePieChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="ageLineChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="ageDoughnutChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ageGroups = @json($ageGroups);

            var ageBarChartCtx = document.getElementById('ageBarChart').getContext('2d');
            new Chart(ageBarChartCtx, {
                type: 'bar',
                data: {
                    labels: Object.keys(ageGroups),
                    datasets: [{
                        label: 'จำนวนผู้สูงอายุ',
                        data: Object.values(ageGroups),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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

            var agePieChartCtx = document.getElementById('agePieChart').getContext('2d');
            new Chart(agePieChartCtx, {
                type: 'pie',
                data: {
                    labels: Object.keys(ageGroups),
                    datasets: [{
                        label: 'สัดส่วนผู้สูงอายุ',
                        data: Object.values(ageGroups),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });

            var ageLineChartCtx = document.getElementById('ageLineChart').getContext('2d');
            new Chart(ageLineChartCtx, {
                type: 'line',
                data: {
                    labels: Object.keys(ageGroups),
                    datasets: [{
                        label: 'แนวโน้มจำนวนผู้สูงอายุ',
                        data: Object.values(ageGroups),
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

            var ageDoughnutChartCtx = document.getElementById('ageDoughnutChart').getContext('2d');
            new Chart(ageDoughnutChartCtx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(ageGroups),
                    datasets: [{
                        label: 'สัดส่วนผู้สูงอายุ (Doughnut)',
                        data: Object.values(ageGroups),
                        backgroundColor: [
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });

            window.onafterprint = function() {
                window.history.back();
            };

            setTimeout(function() {
                window.print();
            }, 1000);
        });
    </script>
</body>
</html>
