<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .navbar {
            height: 60px;
            width: 100%;
            background-color: #333;
            color: #ecf0f1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .sidebar {
            width: 200px;
            background-color: #333;
            height: 100vh;
            position: fixed;
            top: 60px; /* Height of the navbar */
            left: 0;
            padding-top: 20px;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul a {
            color: #ecf0f1;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar ul a:hover {
            background-color: #575757;
        }
        .container {
            margin-left: 220px; /* Width of the sidebar + some margin */
            padding: 20px;
        }
        .footer {
            background-color: #333;
            color: #ecf0f1;
            padding: 10px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: calc(100% - 220px); /* Width of the sidebar + some margin */
            margin-left: 200px; /* Align with the container */
        }
    </style>
</head>
<body>
    <div class="navbar">
        <!-- Navbar content -->
        @include('layout.nav')
    </div>
    
    <div class="sidebar">
        <ul>
            <li><a href="SumADL">ข้อมูลADL</a></li>
            <li><a href="#">ข้อมูลCG</a></li>
            <li><a href="#">แนะนำวิธีรักษา</a></li>
        </ul>
    </div>
    <div class="container">
        <!-- Main content -->
        <h1>Welcome to the Dashboard</h1>
        <p>This is where the main content goes.</p>
    </div>
    <div class="footer">
        <p><a href="#">Contact</a> |<a href="#">Address</a>  | <a href="#">about</a></p>
    </div>
</body>
</html>