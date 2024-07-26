<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Care Instruction</title>
    <!-- Include Bootstrap CSS -->
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- Edit Care Instruction Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4" style="max-width: 600px; margin: auto;">
                        <div class="card-header pb-0">
                            <h6>แก้ไขคำแนะนำ</h6>
                        </div>
                        <div class="card-body px-3 pt-3 pb-2">
                            <form action="{{ route('ci.update', $careInstruction->ID_CI) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="Date_CI">วันที่</label>
                                    <input type="date" id="Date_CI" name="Date_CI" class="form-control" value="{{ $careInstruction->Date_CI }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="Name_Elderly">ชื่อผู้สูงอายุ</label>
                                    <input type="text" id="Name_Elderly" name="Name_Elderly" class="form-control" value="{{ $careInstruction->Name_Elderly }}" readonly>
                                    <input type="hidden" name="ID_Elderly" value="{{ $careInstruction->ID_Elderly }}">
                                </div>
                                <div class="form-group">
                                    <label for="Name_Doctor">ชื่อของหมอ</label>
                                    <input type="text" id="Name_Doctor" name="Name_Doctor" class="form-control" value="{{ $careInstruction->Name_Doctor }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Care_instructions">ข้อมูลคำแนะนำ</label>
                                    <textarea id="Care_instructions" name="Care_instructions" class="form-control" rows="4" required>{{ $careInstruction->Care_instructions }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">ยกเลิก</a>
                            </form>
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
</body>

</html>
