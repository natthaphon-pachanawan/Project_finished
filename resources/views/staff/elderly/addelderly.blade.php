<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Elderly</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #2c3e50;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
            border: none;
        }

        .back-button:hover {
            background-color: #34495e;
        }
    </style>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var initialPosition = [14.9930, 103.1029]; // Initial map position set to Buriram, Thailand

            var map = L.map('map').setView(initialPosition, 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker(initialPosition, { draggable: true }).addTo(map);

            map.on('click', function (e) {
                var clickedLocation = e.latlng;
                marker.setLatLng(clickedLocation);
                document.getElementById('Latitude_position').value = clickedLocation.lat;
                document.getElementById('Longitude_position').value = clickedLocation.lng;
            });

            marker.on('dragend', function (e) {
                var draggedLocation = e.target.getLatLng();
                document.getElementById('Latitude_position').value = draggedLocation.lat;
                document.getElementById('Longitude_position').value = draggedLocation.lng;
            });
        });
    </script>
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('layout.nav')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>เพิ่มข้อมูลผู้สูงอายุ</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('store-elderly') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Name_Elderly">ชื่อ-สกุล:</label>
                        <input type="text" id="Name_Elderly" name="Name_Elderly" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Birthday">วัน/เดือน/ปีเกิด:</label>
                        <input type="date" id="Birthday" name="Birthday" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Address">ที่อยู่:</label>
                        <textarea id="Address" name="Address" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Phone_Elderly">เบอร์โทร:</label>
                        <input type="text" id="Phone_Elderly" name="Phone_Elderly" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Image_Elderly">รูปภาพ:</label>
                        <input type="file" id="Image_Elderly" name="Image_Elderly" class="form-control" accept="image/*">
                    </div>

                    <div id="map"></div>

                    <div class="form-group">
                        <label for="Latitude_position">Latitude Position:</label>
                        <input type="text" id="Latitude_position" name="Latitude_position" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="Longitude_position">Longitude Position:</label>
                        <input type="text" id="Longitude_position" name="Longitude_position" class="form-control">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                        <a href="{{ route('staff-dashboard') }}" class="btn btn-secondary">กลับไปหน้าหลัก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
