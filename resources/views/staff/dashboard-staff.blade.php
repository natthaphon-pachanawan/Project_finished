<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }

        .navbar {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .sidebar {
            width: 200px;
            background-color: #f4f4f4;
            padding: 15px;
            margin-top: 60px;
            position: fixed;
            top: 0;
            bottom: 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: block;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            margin-top: 60px;
            flex-grow: 1;
        }

        .content-section {
            margin-bottom: 20px;
        }

        .content-section h2 {
            margin-bottom: 10px;
        }

        .content-section table,
        .content-section form {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">ระบบประเมินฯ</div>
        <div class="nav-links">
            <a href="#">หน้าแรก</a>
            <a href="#">ประเมินผล</a>
            <a href="#">รายงาน</a>
            @if (Session::has('loginUser'))
                @php
                    $user = app('App\Http\Controllers\AuthController')->getUserAccount(request());
                @endphp
                <li class="nav-item d-flex align-items-center">
                    <span style="margin-right: 10px;">{{ $user->Name_User }}</span>
                    <a class="nav-link btn btn-danger btn-sm" href="{{ url('logout') }}" style="color: white; padding: 5px 10px; font-size: 14px; border-radius: 15px;">Logout</a>
                </li>
            @endif
        </div>
    </div>



    <script src="path/to/your/js/file.js"></script>
</body>

</html>
