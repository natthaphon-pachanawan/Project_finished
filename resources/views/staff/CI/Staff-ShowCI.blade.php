<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff CI Information</title>
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

            <!-- Unconfirmed Care Instructions Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4" >
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5>คำแนะนำการดูแลที่ยังไม่ได้ยืนยัน</h5>
                        </div>
                        <div class="card-body px-3 pt-3 pb-2">
                            <div class="table-responsive p-0">
                                <table id="ciTableUnconfirmed" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">วันที่</th>
                                            <th class="text-center">ชื่อผู้สูงอายุ</th>
                                            <th class="text-center">ที่อยู่</th>
                                            <th class="text-center">เบอร์โทร</th>
                                            <th class="text-center">ชื่อแพทย์</th>
                                            <th class="text-center">คำแนะนำ</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($careInstructions as $ci)
                                            @if(empty($ci->Confirm))
                                                <tr>
                                                    <td class="text-center">{{ $ci->Date_CI }}</td>
                                                    <td class="text-center">{{ $ci->Name_Elderly }}</td>
                                                    <td class="text-center">{{ $ci->elderly->Address }}</td>
                                                    <td class="text-center">{{ $ci->elderly->Phone_Elderly }}</td>
                                                    <td class="text-center">{{ $ci->Name_Doctor }}</td>
                                                    <td class="text-center">{{ $ci->Care_instructions }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('search-location', ['id' => $ci->elderly->ID_Elderly]) }}" target="_blank" class="btn btn-info btn-sm">ค้นหาที่อยู่</a>
                                                        <form action="{{ route('ci.confirm', ['id' => $ci->ID_CI]) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-success btn-sm">ยืนยัน</button>
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
            $('#ciTableUnconfirmed').DataTable({
                "language": {
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
                    }
                },
                "dom": '<"row"<"col-sm-12 col-md-12"l><"col-sm-12 col-md-12"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-2 d-flex justify-content-center"p>>'
             });
        });
    </script>
</body>

</html>
