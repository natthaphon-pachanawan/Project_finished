<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADL Information</title>
    <!-- Argon Dashboard CSS -->
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- Search Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form action="{{ route('adl.index') }}" method="GET" class="d-flex p-3">
                                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อผู้สูงอายุ" value="{{ request()->get('search') }}">
                                <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADL Information Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>ประเมินความสามารถในการดำเนินชีวิตประจำวัน (ADL)</h6>
                            <a href="{{ route('report.all.adl') }}" class="btn btn-success ml-2">
                                <i class="fas fa-file-pdf"></i> ออกรายงาน ADL
                            </a>
                            <a href="adl-elderly" class="btn btn-primary">
                                <i class="fas fa-plus"></i> เพิ่ม ADL
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ชื่อผู้สูงอายุ</th>
                                            <th class="text-center">ชื่อเจ้าหน้าที่</th>
                                            <th class="text-center">คะแนน ADL</th>
                                            <th class="text-center">กลุ่ม ADL</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($adls as $adl)
                                            <tr>
                                                <td class="text-center">{{ $adl->Name_Elderly }}</td>
                                                <td class="text-center">{{ $adl->Name_User }}</td>
                                                <td class="text-center">{{ $adl->Score_ADL }}</td>
                                                <td class="text-center">{{ $adl->Group_ADL }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('report.adl', ['id' => $adl->ID_ADL]) }}" class="btn btn-success btn-sm">ออกรายงาน</a>
                                                    <button onclick="toggleDetails({{ $adl->ID_ADL }})" class="btn btn-info btn-sm">ดูข้อมูล</button>
                                                    <a href="{{ route('adl.edit', ['id' => $adl->ID_ADL]) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                                                    <form action="{{ route('adl.destroy', ['id' => $adl->ID_ADL]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบ ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr id="details-{{ $adl->ID_ADL }}" style="display:none;">
                                                <td colspan="5">
                                                    <div>
                                                        <strong>Feeding (การรับประทานอาหาร):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('feeding', $adl->Feeding) }}
                                                    </div>
                                                    <div>
                                                        <strong>Grooming (การดูแลร่างกาย):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('grooming', $adl->Grooming) }}
                                                    </div>
                                                    <div>
                                                        <strong>Transfer (การย้ายตัว):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('transfer', $adl->Transfer) }}
                                                    </div>
                                                    <div>
                                                        <strong>Toilet Use (การใช้ห้องน้ำ):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('toilet_use', $adl->Toilet_use) }}
                                                    </div>
                                                    <div>
                                                        <strong>Mobility (การเคลื่อนที่ภายในห้องหรือบ้าน):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('mobility', $adl->Mobility) }}
                                                    </div>
                                                    <div>
                                                        <strong>Dressing (การสวมใส่เสื้อผ้า):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('dressing', $adl->Dressing) }}
                                                    </div>
                                                    <div>
                                                        <strong>Stairs (การขึ้นลงบันได 1 ชั้น):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('stairs', $adl->Stairs) }}
                                                    </div>
                                                    <div>
                                                        <strong>Bathing (การอาบน้ำ):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('bathing', $adl->Bathing) }}
                                                    </div>
                                                    <div>
                                                        <strong>Bowels (การกลั้นการถ่ายอุจจาระในระยะ 1 สัปดาห์ที่ผ่านมา):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('bowels', $adl->Bowels) }}
                                                    </div>
                                                    <div>
                                                        <strong>Bladder (การกลั้นปัสสาวะในระยะ 1 สัปดาห์ที่ผ่านมา):</strong> {{ \App\Models\BarthelAdl::getAdlDescription('bladder', $adl->Bladder) }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $adls->links() }} <!-- For pagination links -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Argon Dashboard JS -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}"></script>

    <script>
        function toggleDetails(id) {
            const details = document.getElementById('details-' + id);
            details.style.display = details.style.display === 'none' ? '' : 'none';
        }
    </script>
</body>

</html>
