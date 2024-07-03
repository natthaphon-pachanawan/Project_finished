<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>

</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')
    @include('layout.sidebar-staff')

    <!-- Main Content -->
    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

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
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>ข้อมูลประวัติส่วนตัวของผู้สูงอายุ</h6>
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
                                                <a href="{{ route('edit-elderly', ['id' => $elderly->ID_Elderly]) }}" class="btn btn-warning">Edit</a>
                                                <form action="{{ route('delete-elderly', ['id' => $elderly->ID_Elderly]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this elderly?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
        </div>
    </main>

    <!-- Argon Dashboard JS -->
    <script src="./assets/js/argon-dashboard.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap-notify.js"></script>
    <script src="./assets/js/chartjs.min.js"></script>
    <script src="./assets/js/Chart.extension.js"></script>
    <script src="./assets/js/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/smooth-scrollbar.min.js"></script>
</body>

</html>
