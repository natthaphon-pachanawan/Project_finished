<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบประเมินความสามารถในการดำเนินกิจวัตรประจำวันของผู้สูงอายุ</title>
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">ระบบประเมินฯ</div>
        <ul>
            <li><a href="#">หน้าแรก</a></li>
            <li><a href="#">ข่าวสาร</a></li>
            <li><a href="#">เกี่ยวกับเรา</a></li>
            <li><a href="#">ติดต่อเรา</a></li>
            <li><a href="/login">ล็อกอิน</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>ยินดีต้อนรับสู่ระบบประเมินความสามารถในการดำเนินกิจวัตรประจำวันของผู้สูงอายุ</h1>
    </section>

    <!-- ข่าวสารประชาสัมพันธ์ -->
    <section class="news">
        <h2>ข่าวสารประชาสัมพันธ์</h2>
        <!-- Loop through news articles -->
        <div class="news-item">
            <h3>หัวข้อข่าวสาร</h3>
            <p>รายละเอียดสั้นๆ ของข่าวสาร...</p>
            <a href="#">อ่านเพิ่มเติม</a>
        </div>
    </section>

    <!-- ข้อมูลสถิติ -->
    <section class="statistics">
        <h2>ข้อมูลสถิติ</h2>
        <div class="stats">
            <div class="stat-item">
                <h3>จำนวนผู้เข้าชมเว็บไซต์</h3>
                <p>12345</p>
            </div>
            <div class="stat-item">
                <h3>จำนวนการประเมิน</h3>
                <p>6789</p>
            </div>
        </div>
    </section>

    <!-- ฟอร์มติดต่อ -->
    <section class="contact-form">
        <h2>ติดต่อเรา</h2>
        <form action="path/to/your/form/handler" method="POST">
            <div>
                <label for="name">ชื่อ:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">อีเมล:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="message">ข้อความ:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">ส่งข้อความ</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 สำนักงานสาธารณสุข อำเภอห้วยราช จังหวัดบุรีรัมย์</p>
        <ul>
            <li><a href="#">เกี่ยวกับเรา</a></li>
            <li><a href="#">ข้อกำหนดและเงื่อนไข</a></li>
            <li><a href="#">นโยบายความเป็นส่วนตัว</a></li>
        </ul>
    </footer>

    <script src="path/to/your/js/file.js"></script>
</body>
</html>
