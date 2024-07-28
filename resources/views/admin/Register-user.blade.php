<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>สร้างบัญชี</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="Username">ชื่อผู้ใช้</label>
                        <input type="text" id="Username" name="Username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Email">อีเมล</label>
                        <input type="email" id="Email" name="Email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">รหัสผ่าน</label>
                        <input type="password" id="Password" name="Password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Type_Personnel">ประเภทบุคลากร</label>
                        <select id="Type_Personnel" name="Type_Personnel" class="form-control" required>
                            <option value="">เลือกประเภทบุคลากร</option>
                            @foreach($personnelTypes as $personnel)
                            @if ($personnel->Type_Personnel !== 'Admin')
                            <option value="{{ $personnel->ID_Personnel }}">{{ $personnel->Type_Personnel }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="elderly-type-group" style="display: none;">
                        <label for="Type_Elderly">ประเภทของผู้สูงอายุ</label>
                        <select id="Type_Elderly" name="Type_Elderly" class="form-control">
                            <option value="">เลือกประเภทของผู้สูงอายุ</option>
                            <option value="กลุ่มติดสังคม">ติดสังคม</option>
                            <option value="กลุ่มติดบ้าน">ติดบ้าน</option>
                            <option value="กลุ่มติดเตียง">ติดเตียง</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('Type_Personnel').addEventListener('change', function() {
            var elderlyTypeGroup = document.getElementById('elderly-type-group');
            if (this.options[this.selectedIndex].text === 'Doctor') {
                elderlyTypeGroup.style.display = 'block';
            } else {
                elderlyTypeGroup.style.display = 'none';
            }
        });
    </script>

</body>

</html>
