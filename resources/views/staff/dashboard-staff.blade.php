<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>
        .chart-container {
            position: relative;
            height: 300px;
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



            <!-- Elderly Information -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4>ข้อมูลประวัติส่วนตัวของผู้สูงอายุ</h4>
                            <div class="d-flex gap-2">

                            <a href="add-elderly" class="btn btn-primary">
                                <i class="fas fa-plus"></i> เพิ่มผู้สูงอายุ
                            </a>
                            <a href="{{ route('elderly-report') }}" class="btn btn-success ml-2">
                                <i class="fas fa-print"></i>
                            </a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="myTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">รูป</th>
                                            <th class="text-center">ชื่อ-นามสกุล</th>
                                            <th class="text-center">อายุ</th>
                                            <th class="text-center">ที่อยู่</th>
                                            <th class="text-center">เบอร์โทร</th>
                                            <th class="text-center">แบบประเมิน ADL</th>
                                            <th class="text-center">รายงานการปฏิบัติงาน CG</th>
                                            <th class="text-center">การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($elderlies as $elderly)
                                            <tr>
                                                <td class="text-center">
                                                    @if ($elderly->Image_Elderly)
                                                        <img src="{{ asset('storage/' . $elderly->Image_Elderly) }}"
                                                            alt="Elderly Image" width="50">
                                                    @else
                                                        <img src="{{ asset('storage/default.png') }}"
                                                            alt="Elderly Image" width="50">
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $elderly->Name_Elderly }}</td>
                                                <td class="text-center">
                                                    {{ \Carbon\Carbon::parse($elderly->Birthday)->age }} ปี</td>
                                                <td class="text-center">{{ $elderly->Address }}</td>
                                                <td class="text-center">{{ $elderly->Phone_Elderly }}</td>
                                                <td class="text-center">
                                                    @if ($elderly->barthel_adl)
                                                        ทำแล้ว
                                                    @else
                                                        ยังไม่ทำ
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($elderly->care_giver)
                                                        ทำแล้ว
                                                    @else
                                                        ยังไม่ทำ
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('search-location', ['id' => $elderly->ID_Elderly]) }}"
                                                        target="_blank" class="btn btn-info">ค้นหาที่อยู่</a>
                                                    <a href="{{ route('edit-elderly', ['id' => $elderly->ID_Elderly]) }}"
                                                        class="btn btn-warning">แก้ไข</a>
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $elderly->ID_Elderly }}')">ลบ</button>
                                                        <form action="{{ route('delete-elderly', ['id' => $elderly->ID_Elderly]) }}" method="POST" id="delete-form-{{ $elderly->ID_Elderly }}" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>จำนวนและสัดส่วนของ ADL</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-row">
                                <div class="chart-column">
                                    <div class="chart-container">
                                        <canvas id="adlBarChart"></canvas>
                                    </div>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-container">
                                        <canvas id="adlPieChart"></canvas>
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


    </main>

    <!-- Argon Dashboard JS -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
                    },
                    "search": "ค้นหา : ",
                    "lengthMenu": "แสดง _MENU_ รายการ",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "info": "กำลังแสดงรายการ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                    "infoEmpty": "ไม่พบข้อมูล",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                },
                "dom": '<"row"<"col-sm-12 col-md-12"l><"col-sm-12 col-md-12"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-3 d-flex justify-content-center"p>>'
             });
        });


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
                            beginAtZero: true,
                            display: false // เอาเส้นพื้นหลังออก

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
        });

        @php
            $elderlyLocations = [];
            foreach ($elderlies as $elderly) {
                if ($elderly->addressElderly && $elderly->addressElderly->Latitude_position && $elderly->addressElderly->Longitude_position) {
                    $elderlyLocations[] = [
                        'latitude' => $elderly->addressElderly->Latitude_position,
                        'longitude' => $elderly->addressElderly->Longitude_position,
                        'name' => $elderly->Name_Elderly,
                        'address' => $elderly->Address
                    ];
                }
            }
        @endphp

        document.addEventListener('DOMContentLoaded', function() {
            // ข้อมูลตำแหน่งของผู้สูงอายุ
            var elderlyLocations = @json($elderlyLocations);

            // ตรวจสอบว่ามีข้อมูลพิกัดหรือไม่
            if (elderlyLocations.length > 0) {
                // สร้างแผนที่
                var map = L.map('map').setView([14.971004543091427, 103.18498849868776], 13); // Set initial position to Buriram

                // เพิ่ม TileLayer เพื่อให้แผนที่แสดงผล
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // เพิ่ม Marker สำหรับผู้สูงอายุแต่ละคน
                elderlyLocations.forEach(function(location) {
                    if (location.latitude && location.longitude) { // ตรวจสอบว่าค่าละติจูดและลองจิจูดไม่ใช่ null
                        var marker = L.marker([location.latitude, location.longitude]).addTo(map);

                        // เพิ่มการแสดงที่อยู่ใน popup
                        marker.bindPopup("<b>" + location.name + "</b><br>ที่อยู่: " + location.address);
                    }
                });
            } else {
                console.error("ไม่มีข้อมูลตำแหน่งที่จะแสดงบนแผนที่");
            }
        });


        document.addEventListener('DOMContentLoaded', function() {
            // กราฟของ ADL
            var adlGroups = @json($adlGroups);

            var adlBarChartCtx = document.getElementById('adlBarChart').getContext('2d');
            new Chart(adlBarChartCtx, {
                type: 'bar', // ใช้ type 'bar'
                data: {
                    labels: Object.keys(adlGroups),
                    datasets: [{
                        label: 'จำนวนผู้สูงอายุตามกลุ่ม ADL',
                        data: Object.values(adlGroups),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // ทำให้กราฟแท่งเป็นแนวนอน
                    scales: {
                        x: { // แกน x จะเป็นค่าจำนวน
                            beginAtZero: true,
                            grid: {
                                display: false // เอาเส้นพื้นหลังออก
                            }
                        },
                        y: {
                            grid: {
                                display: false // เอาเส้นพื้นหลังออก
                            }
                        }
                    }
                }
            });



            var adlDoughnutChartCtx = document.getElementById('adlPieChart').getContext('2d');
            new Chart(adlDoughnutChartCtx, {
                type: 'doughnut', // เปลี่ยนจาก 'pie' เป็น 'doughnut'
                data: {
                    labels: Object.keys(adlGroups),
                    datasets: [{
                        label: 'สัดส่วนผู้สูงอายุตามกลุ่ม ADL',
                        data: Object.values(adlGroups),
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

        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถย้อนกลับได้หลังจากลบ!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</body>

</html>
