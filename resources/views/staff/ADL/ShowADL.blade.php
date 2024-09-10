<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADL Information</title>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-xl {
            max-width: 75% !important;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- ADL Information Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>ประเมินความสามารถในการดำเนินชีวิตประจำวัน (ADL)</h6>
                            <a href="{{ route('report.all.adl') }}" class="btn btn-success ml-2">
                                <i class="fas fa-file-pdf"></i> ออกรายงาน ADL
                            </a>
                            <a href="{{ route('adl.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> เพิ่ม ADL
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="adlTable" class="table align-items-center mb-0">
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
                                        @foreach ($adls as $adl)
                                            <tr>
                                                <td class="text-center">{{ $adl->Name_Elderly }}</td>
                                                <td class="text-center">{{ $adl->Name_User }}</td>
                                                <td class="text-center">{{ $adl->Score_ADL }}</td>
                                                <td class="text-center">{{ $adl->Group_ADL }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('report.adl', ['id' => $adl->ID_ADL]) }}"
                                                        class="btn btn-success btn-sm">ออกรายงาน</a>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#adlModal-{{ $adl->ID_ADL }}">ดูข้อมูล</button>
                                                    <a href="{{ route('adl.edit', ['id' => $adl->ID_ADL]) }}"
                                                        class="btn btn-warning btn-sm">แก้ไข</a>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $adl->ID_ADL }}')">ลบ</button>
                                                        <form id="delete-adl-form-{{ $adl->ID_ADL }}" action="{{ route('adl.destroy', ['id' => $adl->ID_ADL]) }}" method="POST" style="display: none;">
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

            <!-- ADL Modals -->
            @foreach ($adls as $adl)
                <div class="modal fade" id="adlModal-{{ $adl->ID_ADL }}" tabindex="-1" aria-labelledby="adlModalLabel-{{ $adl->ID_ADL }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="adlModalLabel-{{ $adl->ID_ADL }}">ข้อมูล ADL ของ {{ $adl->Name_Elderly }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tr>
                                        <th>การรับประทานอาหาร</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('feeding', $adl->Feeding) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การดูแลร่างกาย</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('grooming', $adl->Grooming) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การย้ายตัว</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('transfer', $adl->Transfer) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การใช้ห้องน้ำ</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('toilet_use', $adl->Toilet_use) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การเคลื่อนที่ภายในห้องหรือบ้าน</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('mobility', $adl->Mobility) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การสวมใส่เสื้อผ้า</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('dressing', $adl->Dressing) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การขึ้นลงบันได 1 ชั้น</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('stairs', $adl->Stairs) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การอาบน้ำ</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('bathing', $adl->Bathing) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การกลั้นการถ่ายอุจจาระในระยะ 1 สัปดาห์ที่ผ่านมา</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('bowels', $adl->Bowels) }}</td>
                                    </tr>
                                    <tr>
                                        <th>การกลั้นปัสสาวะในระยะ 1 สัปดาห์ที่ผ่านมา</th>
                                        <td>{{ \App\Models\BarthelAdl::getAdlDescription('bladder', $adl->Bladder) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#adlTable').DataTable({
                "language": {
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-12"l><"col-sm-12 col-md-12"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-2 d-flex justify-content-center"p>>'
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
                    document.getElementById('delete-adl-form-' + id).submit();
                }
            });
        }
    </script>
</body>

</html>
