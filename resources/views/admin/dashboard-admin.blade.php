<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')
    @include('layout.sidebar-admin')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- Search Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form action="{{ route('cg.index') }}" method="GET" class="d-flex p-3">
                                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อผู้ใช้หรือประเภทผู้ใช้" value="{{ request()->get('search') }}">
                                <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">รูป</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">ประเภทของผู้ใช้</th>
                                <th class="text-center">อีเมลล์</th>
                                <th class="text-center">ที่อยู่</th>
                                <th class="text-center">เบอร์โทร</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

