<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
         .sidebar {
            width: 200px;
            background-color: #333;
            height: 100vh;
            position: fixed;
            top: 60px; /* Height of the navbar */
            left: 0;
            padding-top: 20px;
        }
        .sidebar ul a {
            color: #ecf0f1;
            padding-top: 20px;
            text-decoration: none;
            display: block;
        }

    </style>
</head>
<body>
    @include('layout.nav')
    
    <div class="sidebar">
        <ul>
        <a href="SumADL">ข้อมูลADL</a>
        <a href="#">ข้อมูลCG</a>
        <a href="#">แนะนำวิธีรักษา</a>
    </ul>
    </div>
</body>
</html>

