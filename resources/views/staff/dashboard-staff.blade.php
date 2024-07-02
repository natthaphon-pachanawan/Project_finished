<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <!-- Argon Dashboard CSS -->
    <link href="./assets/css/argon-dashboard.css" rel="stylesheet"/>
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet"/>
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <!-- Sidebar -->
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main" style="top: 70px;">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="javascript:void(0)">
                <span class="ms-1 font-weight-bold text-white">Staff Dashboard</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white active bg-gradient-primary" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">ข้อมูลส่วนตัว</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/adl-elderly">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assessment</i>
                        </div>
                        <span class="nav-link-text ms-1">ทำแบบประเมิน (ADL)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">assignment</i>
                        </div>
                        <span class="nav-link-text ms-1">ผลการประเมิน</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">elderly</i>
                        </div>
                        <span class="nav-link-text ms-1">ข้อมูลผู้สูงอายุ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">report</i>
                        </div>
                        <span class="nav-link-text ms-1">รายงาน</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>รายงานผลการปฏิบัติงานผู้ดูแลผู้สูงอายุ</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul>
                                <li><a href="{{ route('activities.create') }}">เพิ่มกิจกรรมการช่วยเหลือของผู้ดูแลผู้สูงอายุ</a></li>
                                <li><a href="caregivers">Show</a></li>
                                <li><a href="caregivers/create">เพิ่มข้อมูล</a></li>
                            </ul>
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
                                                <a href="{{ route('adl-show', ['id' => $elderly->ID_Elderly]) }}" class="btn btn-info">View ADL Results</a>
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
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>ข้อมูลสุขภาพของผู้สูงอายุ</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul>
                                <li><a href="#">เพิ่มข้อมูล</a></li>
                                <li><a href="#">แก้ไขข้อมูล</a></li>
                                <li><a href="#">ลบข้อมูล</a></li>
                            </ul>
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
