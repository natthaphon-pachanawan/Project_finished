<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มคำแนะนำ</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }

        .card-custom {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('layout.nav')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card card-custom mb-4">
                        <div class="card-header pb-0">
                            <h6>เพิ่มคำแนะนำ</h6>
                        </div>
                        <div class="card-body px-3 pt-3 pb-2">
                            <form action="{{ route('ci.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="Date_CI">วันที่</label>
                                    <input type="date" id="Date_CI" name="Date_CI" class="form-control" value="{{ \Carbon\Carbon::now()->toDateString() }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Name_Elderly">ชื่อผู้สูงอายุ</label>
                                    <input type="text" id="Name_Elderly" name="Name_Elderly" class="form-control" value="{{ $elderly->Name_Elderly }}" readonly>
                                    <input type="hidden" name="ID_Elderly" value="{{ $elderly->ID_Elderly }}">
                                </div>
                                <div class="form-group">
                                    <label for="Name_Doctor">ชื่อของหมอ</label>
                                    <input type="text" id="Name_Doctor" name="Name_Doctor" class="form-control" value="{{ Auth::user()->Name_User }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Name_Staff">ชื่อเจ้าหน้าที่</label>
                                    <input type="text" id="Name_Staff" name="Name_Staff" class="form-control" value="{{ $reporter }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Care_instructions">ข้อมูลคำแนะนำ</label>
                                    <textarea id="Care_instructions" name="Care_instructions" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">ยกเลิก</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('assets/js/chartjs.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/smooth-scrollbar.min.js') }}"></script>
</body>

</html>
