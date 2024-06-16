<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 200px;
            background-color: #2c3e50;
            color: #ecf0f1;
            height: 100vh;
            position: fixed;
            top: 60px; /* Height of the navbar */
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 10px 20px;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .main-content {
            margin-left: 220px; /* Width of the sidebar */
            padding: 20px;
            padding-top: 80px; /* Height of the navbar */
            background-color: #ecf0f1;
            min-height: 100vh;
        }

        .content-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .content-section h2 {
            margin-top: 0;
        }

        .content-section ul {
            list-style-type: none;
            padding: 0;
        }

        .content-section ul li {
            padding: 10px 0;
        }
    </style>
</head>

<body>
    @include('layout.nav')

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
        <div class="content-section">
            <h2>ทำแบบประเมินความสามารถในการดำเนินชีวิตประจำวัน</h2>
            <ul>
                <li><a href="#">ดัชนีบาร์เธลเอดีแอล (Barthel ADL index)</a></li>
            </ul>
        </div>

        <div class="content-section">
            <h2>เช็คผลการประเมินความสามารถในการดำเนินชีวิตประจำวัน</h2>
            <ul>
                <li><a href="#">ดัชนีบาร์เธลเอดีแอล (Barthel ADL index)</a></li>
            </ul>
        </div>

        <div class="content-section">
            <h2>รายงานผลการปฏิบัติงานผู้ดูแลผู้สูงอายุ</h2>
            <ul>
                <li><a href="#">เพิ่มข้อมูล</a></li>
                <li><a href="#">แก้ไขข้อมูล</a></li>
                <li><a href="#">ลบข้อมูล</a></li>
            </ul>
        </div>

        <div class="content-section">
            <h2>ข้อมูลประวัติส่วนตัวของผู้สูงอายุ</h2>
            <ul>
                <li><a href="#">เพิ่มข้อมูล</a></li>
                <li><a href="#">แก้ไขข้อมูล</a></li>
                <li><a href="#">ลบข้อมูล</a></li>
            </ul>
        </div>

        <div class="content-section">
            <h2>ข้อมูลสุขภาพของผู้สูงอายุ</h2>
            <ul>
                <li><a href="#">เพิ่มข้อมูล</a></li>
                <li><a href="#">แก้ไขข้อมูล</a></li>
                <li><a href="#">ลบข้อมูล</a></li>
            </ul>
        </div>

        <div class="content-section">
            <h2>ค้นหาตำแหน่งพิกัดที่อยู่อาศัยของผู้สูงอายุ</h2>
            <!-- Add content here -->
        </div>

        <div class="content-section">
            <h2>ออกรายงานของระบบ</h2>
            <ul>
                <li><a href="#">ข้อมูลผลการประเมิน ADL</a></li>
                <li><a href="#">ข้อมูลผลการปฏิบัติงานผู้ดูแลผู้สูงอายุในรอบรายเดือน รายวัน (care giver)</a></li>
                <li><a href="#">ข้อมูลผู้สูงอายุ</a></li>
                <li><a href="#">รายงานผู้สูงอายุรูปแบบแท่งกราฟ</a></li>
            </ul>
        </div>
    </div>

</body>

</html>
