<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Page</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            margin-left: 20px;
        }

        .navbar .nav-center {
            display: flex;
            gap: 1cm;
        }

        .navbar .nav-center a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .navbar .nav-center a:hover {
            color: #ff6347;
        }

        .navbar .profile {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-right: 3cm;
        }

        .navbar .profile .username {
            margin-right: 10px;
        }

        .navbar .profile .dropdown {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: #fff;
            color: #333;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            overflow: hidden;
            z-index: 1001;
        }

        .navbar .profile .dropdown a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            transition: background-color 0.3s;
        }

        .navbar .profile .dropdown a:hover {
            background-color: #f4f4f4;
        }

        .main-content {
            padding: 20px;
            margin-top: 80px;
        }

        .content-section {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content-section h2 {
            margin-bottom: 10px;
            color: #333;
        }

        .content-section table,
        .content-section form {
            width: 100%;
        }

        .profile:hover .dropdown {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">LOGO</div>
        <div class="nav-center">
            <a href="#">หน้าแรก</a>
            <a href="#">ประเมินผล</a>
            <a href="#">รายงาน</a>
        </div>
        <div class="profile">
            <span class="username">John Doe</span>
            <div class="dropdown">
                <a href="#"><span>⚙️</span> Setting</a>
                <a href="#"><span>🚪</span>LogOut</a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const profile = document.querySelector('.profile');
            const dropdown = document.querySelector('.profile .dropdown');

            profile.addEventListener('click', () => {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });

            window.addEventListener('click', (e) => {
                if (!profile.contains(e.target)) {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>
    <script src="path/to/your/js/file.js"></script>
</body>
</html>
