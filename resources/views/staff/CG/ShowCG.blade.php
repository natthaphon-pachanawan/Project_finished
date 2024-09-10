<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CG Information</title>
    <!-- Argon Dashboard CSS -->
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .container {
            margin-top: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- CG Information Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>แบบฟอร์มรายงานผลการปฏิบัติงานผู้ดูแลผู้สูงอายุ (CG)</h6>
                            <a href="{{ route('report.all.cg') }}" class="btn btn-success ml-2">
                                <i class="fas fa-file-pdf"></i> ออกรายงาน CG
                            </a>
                            <a href="{{ route('cg.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> เพิ่ม CG
                            </a>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="cgTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">วันที่</th>
                                            <th class="text-center">ชื่อผู้สูงอายุ</th>
                                            <th class="text-center">ชื่อผู้ดูแลผู้สูงอายุ</th>
                                            <th class="text-center">กลุ่ม ADL</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($careGivers as $cg)
                                            <tr>
                                                <td class="text-center">{{ $cg->Date_CG }}</td>
                                                <td class="text-center">{{ $cg->Name_Elderly }}</td>
                                                <td class="text-center">{{ $cg->Name_CG }}</td>
                                                <td class="text-center">{{ $cg->Group_ADL }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('report.cg', ['id' => $cg->ID_CG]) }}" class="btn btn-success btn-sm">ออกรายงาน</a>
                                                    <a href="{{ route('cg.edit', ['id' => $cg->ID_CG]) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                                                    <form id="delete-cg-form-{{ $cg->ID_CG }}"
                                                        action="{{ route('cg.destroy', ['id' => $cg->ID_CG]) }}"
                                                        method="POST" style="display:inline-block;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $cg->ID_CG }}')">ลบ</button>
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
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cgTable').DataTable({
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
                        document.getElementById('delete-cg-form-' + id).submit();
                    }
                });
            }
    </script>
</body>

</html>
