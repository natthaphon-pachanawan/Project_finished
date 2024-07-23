<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage User</title>
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
                            <h6>จัดการข้อมูลผู้ใช้</h6>
                            <a href="{{ route('admin.report-user') }}" class="btn btn-success ml-2">
                                <i class="fas fa-file-pdf"></i> ออกรายงาน
                            </a>
                            <a href="{{ route('user.register') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> สร้างบัญชี
                            </a>

                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">รูป</th>
                                            <th class="text-center">ชื่อ</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">ประเภทของผู้ใช้</th>
                                            <th class="text-center">อีเมลล์</th>
                                            <th class="text-center">ที่อยู่</th>
                                            <th class="text-center">เบอร์โทร</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">
                                                    <img src="{{ asset($user->Image_User) }}" alt="User Image" class="img-fluid" style="max-width: 50px;">
                                                </td>
                                                <td class="text-center">{{ $user->Name_User ?: 'ไม่มีข้อมูล' }}</td>
                                                <td class="text-center">{{ $user->Username ?: 'ไม่มีข้อมูล' }}</td>
                                                <td class="text-center">{{ $user->Type_Personnel }}</td>
                                                <td class="text-center">{{ $user->Email ?: 'ไม่มีข้อมูล' }}</td>
                                                <td class="text-center">{{ $user->Address ?: 'ไม่มีข้อมูล' }}</td>
                                                <td class="text-center">{{ $user->Phone ?: 'ไม่มีข้อมูล' }}</td>
                                                <td class="text-center">
                                                    @if ($user->Type_Personnel !== 'Admin')
                                                        <form action="{{ route('user.delete', $user->ID_User) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบบัญชีนี้?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                                        </form>
                                                    @endif
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
</body>
</html>

