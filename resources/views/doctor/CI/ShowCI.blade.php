<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Instructions</title>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- Care Instructions Information Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4" style="max-width: 1200px; margin: auto;">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>คำแนะนำการดูแล</h6>
                        </div>
                        <div class="card-body px-3 pt-3 pb-2">
                            <div class="table-responsive p-0">
                                <table id="ciTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">วันที่</th>
                                            <th class="text-center">ชื่อผู้สูงอายุ</th>
                                            <th class="text-center">ชื่อหมอ</th>
                                            <th class="text-center">คำแนะนำ</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($careInstructions as $ci)
                                            @if(empty($ci->Name_Staff))
                                                <tr>
                                                    <td class="text-center">{{ $ci->Date_CI }}</td>
                                                    <td class="text-center">{{ $ci->Name_Elderly }}</td>
                                                    <td class="text-center">{{ $ci->Name_Doctor }}</td>
                                                    <td class="text-center">{{ $ci->Care_instructions }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('ci.edit', ['id' => $ci->ID_CI]) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                                                        <form action="{{ route('ci.destroy', ['id' => $ci->ID_CI]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบ ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
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

    <!-- Include Argon Dashboard JS -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ciTable').DataTable();
        });
    </script>
</body>

</html>
