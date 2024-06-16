<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบประเมินความสามารถในการดำเนินกิจวัตรประจำวันของผู้สูงอายุ</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
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
