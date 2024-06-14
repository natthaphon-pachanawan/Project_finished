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

        .navbar .nav-links a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            position: relative;
        }

        .navbar .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            cursor: pointer;
        }

        .navbar .user-info .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1001;
        }

        .navbar .user-info .dropdown a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }

        .navbar .user-info .dropdown a:hover {
            background-color: #f4f4f4;
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
        </div>
        @if (Session::has('loginUser'))
            @php
                $user = app('App\Http\Controllers\AuthController')->getUserAccount(request());
            @endphp
            <div class="user-info">
                <img src="{{ $user->Image_User }}" alt="Profile Image" onclick="toggleDropdown()">
                <span onclick="toggleDropdown()">{{ $user->Name_User }}</span>
                <div class="dropdown" id="userDropdown">
                    <a href="{{url('profile-staff')}}">Profile</a>
                    <a href="{{ url('login') }}">Logout</a>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="#">ข้อมูลส่วนตัว</a></li>
            <li><a href="#">ทำแบบประเมิน</a></li>
            <li><a href="#">ผลการประเมิน</a></li>
            <li><a href="#">ข้อมูลผู้สูงอายุ</a></li>
            <li><a href="#">รายงาน</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Your main content here -->
    </div>

    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("userDropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.user-info img') && !event.target.matches('.user-info span')) {
                var dropdowns = document.getElementsByClassName("dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>
