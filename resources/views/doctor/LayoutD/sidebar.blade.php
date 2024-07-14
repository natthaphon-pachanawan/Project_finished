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
            display: flex;
        }
        .side-bar {
            width: 250px;
            height: calc(100vh - 10px); 
            background-color: #f05b16;
            color: rgba(255, 255, 255, 0.036);
            padding: 15px;
            box-shadow: 2px 0 5px rgba(18, 18, 18, 0.842);
            margin-top: 5px; 
        }
        .side-bar h2 {
            margin: 0 0 20px 0;
            font-size: 24px;
            text-align: center;
        }
        .side-bar ul {
            list-style: none;
            padding: 0;
        }
        .side-bar ul li {
            padding: 10px 0;
        }
        .side-bar ul li a {
            color: rgb(23, 22, 22);
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .side-bar ul li a:hover {
            background-color: #1ead1e;
            transform: translateX(10px);
        }
        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="side-bar">
        <h2>Doctor</h2>
        <ul>
            <li><a href="SumADL">ข้อมูล(ADL)</a></li>
            <li><a href="Sum_CG">ข้อมูล(CG)</a></li>
            <li><a href="Showreport">แนะนำการดูแลรักษา</a></li>
        </ul>
    </div>
</body>
</html>
