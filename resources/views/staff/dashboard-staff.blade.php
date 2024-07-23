<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            position: relative;
            height: 300px; /* Adjust the height as needed */
            width: 100%;
        }

        .chart-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .chart-column {
            flex: 1;
            min-width: 300px;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <!-- Main Content -->
    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- Search Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form action="{{ route('staff-dashboard') }}" method="GET" class="d-flex p-3">
                                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อผู้สูงอายุ" value="{{ request()->get('search') }}">
                                <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Elderly Information -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>ข้อมูลประวัติส่วนตัวของผู้สูงอายุ</h6>
                            <a href="{{ route('elderly-report') }}" class="btn btn-success ml-2">
                                <i class="fas fa-file-pdf"></i> ออกรายงาน
                            </a>
                            <a href="add-elderly" class="btn btn-primary">
                                <i class="fas fa-plus"></i> เพิ่มผู้สูงอายุ
                            </a>

                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">รูป</th>
                                            <th class="text-center">ชื่อ</th>
                                            <th class="text-center">อายุ</th>
                                            <th class="text-center">ที่อยู่</th>
                                            <th class="text-center">เบอร์โทร</th>
                                            <th class="text-center">แบบประเมิน ADL</th>
                                            <th class="text-center">รายงานการปฏิบัติงาน CG</th>
                                            <th class="text-center">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($elderlies as $elderly)
                                        <tr>
                                            <td class="text-center">
                                                @if($elderly->Image_Elderly)
                                                    <img src="{{ asset('storage/'.$elderly->Image_Elderly) }}" alt="Elderly Image" width="50">
                                                @else
                                                    <img src="{{ asset('storage/default.png') }}" alt="Elderly Image" width="50">
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $elderly->Name_Elderly }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($elderly->Birthday)->age }} ปี</td>
                                            <td class="text-center">{{ $elderly->Address }}</td>
                                            <td class="text-center">{{ $elderly->Phone_Elderly }}</td>
                                            <td class="text-center">
                                                @if($elderly->barthel_adl)
                                                    ทำแล้ว
                                                @else
                                                    ยังไม่ทำ
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($elderly->care_giver)
                                                    ทำแล้ว
                                                @else
                                                    ยังไม่ทำ
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('search-location', ['id' => $elderly->ID_Elderly]) }}" target="_blank" class="btn btn-info">ค้นหาที่ตั้ง</a>
                                                <a href="{{ route('edit-elderly', ['id' => $elderly->ID_Elderly]) }}" class="btn btn-warning">แก้ไข</a>
                                                <form action="{{ route('delete-elderly', ['id' => $elderly->ID_Elderly]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบ ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">ลบ</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $elderlies->links() }} <!-- For pagination links -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Combined Graphs -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>จำนวนและสัดส่วนผู้สูงอายุตามช่วงอายุ</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-row">
                                <div class="chart-column">
                                    <div class="chart-container">
                                        <canvas id="ageBarChart"></canvas>
                                    </div>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-container">
                                        <canvas id="agePieChart"></canvas>
                                    </div>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-container">
                                        <canvas id="ageLineChart"></canvas>
                                    </div>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-container">
                                        <canvas id="ageDoughnutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>แผนที่แสดงที่ตั้งผู้สูงอายุ</h6>
                        </div>
                        <div class="card-body">
                            <div id="map" style="height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Argon Dashboard JS -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    {{--  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>  --}}
    {{--  <script src="{{ asset('assets/js/plugins/Chart.extension.js') }}"></script>  --}}
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
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

            // ข้อมูลตำแหน่งของผู้สูงอายุ
            var elderlyLocations = @json($elderlies->map(function($elderly) {
                return [
                    $elderly->addressElderly->Latitude_position,
                    $elderly->addressElderly->Longitude_position,
                    $elderly->Name_Elderly
                ];
            }));

            // สร้างแผนที่
            var map = L.map('map').setView([14.9930, 103.1029], 15); // Set initial position to Buriram

            // เพิ่ม TileLayer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // เพิ่ม Marker สำหรับผู้สูงอายุแต่ละคน
            elderlyLocations.forEach(function(location) {
                var marker = L.marker([location[0], location[1]]).addTo(map);
                marker.bindPopup("<b>" + location[2] + "</b>").openPopup();
            });
        });
    </script>
</body>

</html>
