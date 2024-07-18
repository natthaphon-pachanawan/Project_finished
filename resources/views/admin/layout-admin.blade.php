<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #344767;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fb6340;
            padding: 10px 20px;
        }
        nav .logo {
            font-size: 1.5em;
            color: #fff;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
        }
        nav ul li a:hover {
            background-color: #ea3005;
            border-radius: 5px;
        }
        .hero {
            background-color: #63B3ED;
            color: #fff;
            text-align: center;
            padding: 50px 20px;
            margin-bottom: 20px;
        }
        .news, .statistics, .contact-form {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .news h2, .statistics h2, .contact-form h2 {
            margin-bottom: 20px;
        }
        .news-item, .stat-item {
            margin-bottom: 15px;
        }
        .news-item h3, .stat-item h3 {
            margin-bottom: 5px;
        }
        .news-item p {
            margin-bottom: 10px;
        }
        .news-item a {
            color: #fb6340;
            text-decoration: none;
        }
        .news-item a:hover {
            text-decoration: underline;
        }
        .statistics .stats {
            display: flex;
            gap: 20px;
        }
        .statistics .stat-item {
            flex: 1;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .contact-form form div {
            margin-bottom: 15px;
        }
        .contact-form label {
            display: block;
            margin-bottom: 5px;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .contact-form button {
            background-color: #fb6340;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .contact-form button:hover {
            background-color: #ea3005;
        }
        footer {
            background-color: #344767;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        footer ul li {
            display: inline;
        }
        footer ul li a {
            color: #fff;
            text-decoration: none;
        }
        footer ul li a:hover {
            text-decoration: underline;
        }

        .slides {
            display: flex;
            overflow: hidden;
            width: 100%;
            height: 300px;
        }
        .slides img {
            width: 100%;
            height: auto;
            flex-shrink: 0;
            transition: transform 0.5s ease-in-out;
        }

        .admin-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .admin-controls a, .admin-controls form button {
            background-color: #fb6340;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .admin-controls a:hover, .admin-controls form button:hover {
            background-color: #ea3005;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">ระบบประเมินฯ</div>
        <ul>
            <li><a href="{{ route('welcome') }}">หน้าแรก</a></li>
            <li><a href="{{ route('admin.news.index') }}">จัดการข่าวสาร</a></li>
            <li><a href="{{ route('admin.sliders.index') }}">จัดการ Slider</a></li>
        </ul>
    </nav>

    <div class="container">
        <!-- Admin Controls -->
        <div class="admin-controls">
            <a href="{{ route('admin.news.create') }}">เพิ่มข่าวสาร</a>
            <a href="{{ route('admin.sliders.create') }}">เพิ่มรูปเลื่อน Slider</a>
        </div>

        @yield('content')
    </div>
</body>
</html>
