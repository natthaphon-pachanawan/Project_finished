<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Elderly</title>
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
    </style>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('layout.nav')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>แก้ไขข้อมูลผู้สูงอายุ</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('update-elderly', ['id' => $elderly->ID_Elderly]) }}" method="POST" enctype="multipart/form-data" onsubmit="concatenateAddress()">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Name_Elderly">ชื่อ-สกุล:</label>
                        <input type="text" id="Name_Elderly" name="Name_Elderly" class="form-control" value="{{ $elderly->Name_Elderly }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Birthday">วัน/เดือน/ปีเกิด:</label>
                        <input type="date" id="Birthday" name="Birthday" class="form-control" value="{{ $elderly->Birthday }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Province">จังหวัด:</label>
                        <select id="Province" name="Province" class="form-control" required>
                            <option value="">เลือกจังหวัด</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="District">อำเภอ:</label>
                        <select id="District" name="District" class="form-control" required>
                            <option value="">เลือกอำเภอ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Subdistrict">ตำบล:</label>
                        <select id="Subdistrict" name="Subdistrict" class="form-control" required>
                            <option value="">เลือกตำบล</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Address">ที่อยู่ (บ้านเลขที่, ถนน, ซอย):</label>
                        <textarea id="Address" name="Address" class="form-control" required>{{ $elderly->Address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="Postal_Code">รหัสไปรษณีย์:</label>
                        <input type="text" id="Postal_Code" name="Postal_Code" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="Phone_Elderly">เบอร์โทร:</label>
                        <input type="text" id="Phone_Elderly" name="Phone_Elderly" class="form-control" value="{{ $elderly->Phone_Elderly }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Image_Elderly">รูปภาพ:</label>
                        <input type="file" id="Image_Elderly" name="Image_Elderly" class="form-control" accept="image/*">
                        @if($elderly->Image_Elderly)
                        <img src="{{ asset('storage/'.$elderly->Image_Elderly) }}" alt="Elderly Image" width="100">
                        @endif
                    </div>

                    <div id="map"></div>

                    <div class="form-group">
                        <label for="Latitude_position">Latitude Position:</label>
                        <input type="text" id="Latitude_position" name="Latitude_position" class="form-control" value="{{ $addressElderly->Latitude_position }}">
                    </div>

                    <div class="form-group">
                        <label for="Longitude_position">Longitude Position:</label>
                        <input type="text" id="Longitude_position" name="Longitude_position" class="form-control" value="{{ $addressElderly->Longitude_position }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">อัพเดต</button>
                        <a href="{{ route('staff-dashboard') }}" class="btn btn-secondary">กลับไปหน้าหลัก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let provincesData;

        // Load provinces data from the asset path
        $.getJSON("{{ asset('API/api_province_with_amphure_tambon.json') }}", function (data) {
            provincesData = data;
            let provinceSelect = $('#Province');

            // Populate province dropdown
            provincesData.forEach(function (province) {
                provinceSelect.append(`<option value="${province.id}">${province.name_th}</option>`);
            });

            // Set initial values based on the existing data
            extractAddressParts("{{ $elderly->Address }}");
        });

        // Extract address parts and set them in the form fields
        function extractAddressParts(address) {
            const provinceSelect = $('#Province');
            const districtSelect = $('#District');
            const subdistrictSelect = $('#Subdistrict');
            const postalCodeField = $('#Postal_Code');
            const addressField = $('#Address');

            // Split the address string into parts
            const parts = address.match(/จังหวัด(.*?) อำเภอ(.*?) ตำบล(.*?) (.*?) รหัสไปรษณีย์ (\d+)/);

            if (parts && parts.length === 6) {
                const provinceName = parts[1];
                const districtName = parts[2];
                const subdistrictName = parts[3];
                const detailedAddress = parts[4]; // This is the part that includes the house number, street, etc.
                const postalCode = parts[5];

                // Set province, district, subdistrict, and postal code
                const province = provincesData.find(prov => prov.name_th === provinceName.trim());
                if (province) {
                    provinceSelect.val(province.id).trigger('change');
                    setTimeout(function () {
                        const district = province.amphure.find(dist => dist.name_th === districtName.trim());
                        if (district) {
                            districtSelect.val(district.id).trigger('change');
                            setTimeout(function () {
                                const subdistrict = district.tambon.find(subdist => subdist.name_th === subdistrictName.trim());
                                if (subdistrict) {
                                    subdistrictSelect.val(subdistrict.id);
                                }
                            }, 500); // Wait for the district dropdown to populate
                        }
                    }, 500); // Wait for the province dropdown to populate
                }

                // Set postal code
                postalCodeField.val(postalCode);

                // Set detailed address (house number, street, etc.)
                addressField.val(detailedAddress.trim());
            }
        }

        // Handle province selection
        $('#Province').change(function () {
            let provinceId = $(this).val();
            let districtSelect = $('#District');
            let subdistrictSelect = $('#Subdistrict');
            districtSelect.empty().append('<option value="">เลือกอำเภอ</option>');
            subdistrictSelect.empty().append('<option value="">เลือกตำบล</option>');

            let selectedProvince = provincesData.find(prov => prov.id == provinceId);
            if (selectedProvince) {
                selectedProvince.amphure.forEach(function (district) {
                    districtSelect.append(`<option value="${district.id}">${district.name_th}</option>`);
                });
            }
        });

        // Handle district selection
        $('#District').change(function () {
            let districtId = $(this).val();
            let subdistrictSelect = $('#Subdistrict');
            subdistrictSelect.empty().append('<option value="">เลือกตำบล</option>');

            let selectedProvince = provincesData.find(prov => prov.id == $('#Province').val());
            let selectedDistrict = selectedProvince.amphure.find(dist => dist.id == districtId);
            if (selectedDistrict) {
                selectedDistrict.tambon.forEach(function (subdistrict) {
                    subdistrictSelect.append(`<option value="${subdistrict.id}">${subdistrict.name_th}</option>`);
                });
            }
        });

        // Leaflet Map for selecting location
        var initialPosition = [{{ $addressElderly->Latitude_position ?? 14.971004543091427}}, {{ $addressElderly->Longitude_position ?? 103.18498849868776 }}]; // Initial map position set to the elderly's current location or default to Buriram, Thailand
        var map = L.map('map').setView(initialPosition, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(initialPosition, { draggable: true }).addTo(map);

        map.on('click', function (e) {
            var clickedLocation = e.latlng;
            marker.setLatLng(clickedLocation);
            $('#Latitude_position').val(clickedLocation.lat);
            $('#Longitude_position').val(clickedLocation.lng);
        });

        marker.on('dragend', function (e) {
            var draggedLocation = e.target.getLatLng();
            $('#Latitude_position').val(draggedLocation.lat);
            $('#Longitude_position').val(draggedLocation.lng);
        });

        // Function to concatenate address parts before form submission
        function concatenateAddress() {
            let province = $('#Province option:selected').text();
            let district = $('#District option:selected').text();
            let subdistrict = $('#Subdistrict option:selected').text();
            let postalCode = $('#Postal_Code').val();
            let detailedAddress = $('#Address').val();

            let fullAddress = `จังหวัด${province} อำเภอ${district} ตำบล${subdistrict} ${detailedAddress} รหัสไปรษณีย์ ${postalCode}`;
            $('#Address').val(fullAddress);
        }
    </script>
</body>

</html>
