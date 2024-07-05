<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADL Assessment</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .total-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-weight: bold;
        }

        .total-group span {
            font-size: 18px;
        }

        button,
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }

        button:hover,
        .back-button:hover {
            background-color: #2980b9;
        }

        .back-button {
            margin-left: 10px;
        }

        .success {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
    <script>
        function calculateTotalScore() {
            let score = 0;
            const radios = document.querySelectorAll('input[type="radio"]:checked');
            radios.forEach(radio => {
                score += parseInt(radio.value);
            });
            document.getElementById('total_score').innerText = score;

            let group = '';
            if (score >= 0 && score <= 4) {
                group = 'กลุ่มติดสังคม';
            } else if (score >= 5 && score <= 11) {
                group = 'กลุ่มติดบ้าน';
            } else if (score >= 12) {
                group = 'กลุ่มติดเตียง';
            }
            document.getElementById('group').innerText = group;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                radio.addEventListener('change', calculateTotalScore);
            });
        });
    </script>
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('layout.nav')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>แบบฟอร์มประเมินความสามารถในการดำเนินชีวิตประจำวัน (ADL)</h1>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('adl.submit') }}">
                    @csrf

                    <!-- Select Elderly Name -->
                    <div class="form-group">
                        <label for="elderly_id">เลือกผู้สูงอายุ:</label>
                        <select name="elderly_id" id="elderly_id" class="form-control" required>
                            @foreach($elderlies as $elderly)
                            <option value="{{ $elderly->ID_Elderly }}">{{ $elderly->Name_Elderly }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Display Name of User performing the assessment -->
                    <div class="form-group">
                        <label>เจ้าหน้าที่ผู้รับผิดชอบในการทำแบบฟอร์ม:</label>
                        <span>{{ Auth::user()->Name_User }}</span>
                    </div>

                    <!-- ADL Questions -->
                    <h2>1. Feeding (การรับประทานอาหาร):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="feeding" value="2" required> ไม่สามารถตักอาหารเข้าปากได้ต้องมีคนป้อนให้</label><br>
                        <label><input type="radio" name="feeding" value="1"> ตักอาหารเองได้แต่ต้องมีคนช่วย เช่น ช่วยใช้ช้อนตักเตรียมไว้ให้หรือตัดเป็นเล็ก ๆ ไว้ล่วงหน้า</label><br>
                        <label><input type="radio" name="feeding" value="0"> ตักอาหารและช่วยตัวเองได้เป็นปกติ</label><br>
                    </div>

                    <h2>2. Grooming (การดูแลร่างกาย):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="grooming" value="1" required> ต้องการความช่วยเหลือ</label><br>
                        <label><input type="radio" name="grooming" value="0"> ทำเองได้ (รวมทั้งที่ทำได้เองถ้าเตรียมอุปกรณ์ไว้ให้)</label><br>
                    </div>

                    <h2>3. Transfer (การย้ายตัว):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="transfer" value="3" required> ไม่สามารถนั่งได้ (นั่งแล้วจะล้มเสมอ) หรือต้องใช้คนสองคนช่วยกันยกขึ้น</label><br>
                        <label><input type="radio" name="transfer" value="2"> ต้องการความช่วยเหลืออย่างมากจึงจะนั่งได้ เช่น ต้องใช้คนที่แข็งแรงหรือมีทักษะ 1 คน หรือใช้คนทั่วไป 2 คนพยุงหรือดันขึ้นมาจึงจะนั่งอยู่ได้</label><br>
                        <label><input type="radio" name="transfer" value="1"> ต้องการความช่วยเหลือบ้าง เช่น บอกให้ทำตาม หรือช่วยพยุงเล็กน้อย หรือต้องมีคนดูแลเพื่อความปลอดภัย</label><br>
                        <label><input type="radio" name="transfer" value="0"> ทำได้เอง</label><br>
                    </div>

                    <h2>4. Toilet use (การใช้ห้องน้ำ):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="toilet_use" value="2" required> ช่วยตัวเองไม่ได้</label><br>
                        <label><input type="radio" name="toilet_use" value="1"> ทำเองได้บ้าง (อย่างน้อยทำความสะอาดตัวเองได้หลังจากเสร็จธุระ) แต่ต้องการความช่วยเหลือในบางสิ่ง</label><br>
                        <label><input type="radio" name="toilet_use" value="0"> ทำเองได้ดี (ขึ้นนั่งและลงจากโถส้วมเองได้ ทำความสะอาดได้เรียบร้อยหลังจากเสร็จธุระ ถอดใส่เสื้อผ้าได้เรียบร้อย)</label><br>
                    </div>

                    <h2>5. Mobility (การเคลื่อนที่ภายในห้องหรือบ้าน):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="mobility" value="3" required> เคลื่อนที่ไปไหนไม่ได้</label><br>
                        <label><input type="radio" name="mobility" value="2"> ต้องใช้รถเข็นช่วยตัวเองให้เคลื่อนที่ได้เอง (ไม่ต้องมีคนเข็นให้) และจะต้องเข้าออกมุมห้องหรือประตูได้</label><br>
                        <label><input type="radio" name="mobility" value="1"> เดินหรือเคลื่อนที่โดยมีคนช่วย เช่น พยุง หรือบอกให้ทำตาม หรือต้องให้ความสนใจดูแลเพื่อความปลอดภัย</label><br>
                        <label><input type="radio" name="mobility" value="0"> เดินหรือเคลื่อนที่ได้เอง</label><br>
                    </div>

                    <h2>6. Dressing (การสวมใส่เสื้อผ้า):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="dressing" value="2" required> ต้องมีคนสวมให้ ช่วยตัวเองแทบไม่ได้หรือได้น้อย</label><br>
                        <label><input type="radio" name="dressing" value="1"> ช่วยตัวเองได้ประมาณร้อยละ 50 ที่เหลือต้องมีคนช่วย</label><br>
                        <label><input type="radio" name="dressing" value="0"> ช่วยตัวเองได้ดี (รวมทั้งการติดกระดุม รูดซิบ หรือใช้เสื้อผ้าที่ดัดแปลงให้เหมาะสมก็ได้)</label><br>
                    </div>

                    <h2>7. Stairs (การขึ้นลงบันได 1 ชั้น):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="stairs" value="2" required> ไม่สามารถทำได้</label><br>
                        <label><input type="radio" name="stairs" value="1"> ต้องการคนช่วย</label><br>
                        <label><input type="radio" name="stairs" value="0"> ขึ้นลงได้เอง (ถ้าต้องใช้เครื่องช่วยเดิน เช่น walker จะต้องเอาขึ้นลงได้ด้วย)</label><br>
                    </div>

                    <h2>8. Bathing (การอาบน้ำ):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="bathing" value="1" required> ต้องมีคนช่วยหรือทำให้</label><br>
                        <label><input type="radio" name="bathing" value="0"> อาบน้ำเองได้</label><br>
                    </div>

                    <h2>9. Bowels (การกลั้นการถ่ายอุจจาระในระยะ 1 สัปดาห์ที่ผ่านมา):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="bowels" value="2" required> กลั้นไม่ได้ หรือต้องการการสวนอุจจาระอยู่เสมอ</label><br>
                        <label><input type="radio" name="bowels" value="1"> กลั้นไม่ได้บางครั้ง (เป็นน้อยกว่า 1 ครั้งต่อสัปดาห์)</label><br>
                        <label><input type="radio" name="bowels" value="0"> กลั้นได้เป็นปกติ</label><br>
                    </div>

                    <h2>10. Bladder (การกลั้นปัสสาวะในระยะ 1 สัปดาห์ที่ผ่านมา):</h2>
                    <div class="form-group">
                        <label><input type="radio" name="bladder" value="2" required> กลั้นไม่ได้ หรือใส่สายสวนปัสสาวะแต่ไม่สามารถดูแลเองได้</label><br>
                        <label><input type="radio" name="bladder" value="1"> กลั้นไม่ได้บางครั้ง (เป็นน้อยกว่าวันละ 1 ครั้ง)</label><br>
                        <label><input type="radio" name="bladder" value="0"> กลั้นได้เป็นปกติ</label><br>
                    </div>

                    <!-- Total Score and Group -->
                    <div class="total-group">
                        <div>
                            <label>คะแนนรวม:</label>
                            <span id="total_score">0</span>
                        </div>
                        <div>
                            <label>ประเภทกลุ่ม:</label>
                            <span id="group">N/A</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">ยืนยัน</button>
                    <a href="{{ route('adl.index') }}" class="btn btn-secondary">กลับไปหน้า ADL</a>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
