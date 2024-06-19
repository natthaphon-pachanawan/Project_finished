{{--  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ทำแบบประเมิน ADL</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group .score {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group .score label {
            margin: 0;
            font-weight: normal;
        }

        .form-group .score input {
            width: auto;
            margin-right: 10px;
        }

        .btn-submit {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .btn-submit:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('layout.nav')

    <!-- Main Content -->
    <div class="container">
        <h1>ทำแบบประเมินความสามารถในการดำเนินชีวิตประจำวัน (ADL)</h1>
        <form action="{{ route('adl-assessment.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="patient_name">ชื่อผู้ป่วย</label>
                <input type="text" id="patient_name" name="patient_name" required>
            </div>
            <div class="form-group">
                <label for="assessment_date">วันที่ทำการประเมิน</label>
                <input type="date" id="assessment_date" name="assessment_date" required>
            </div>
            <div class="form-group">
                <label>การประเมิน</label>
                <div class="score">
                    <label for="feeding">การให้อาหาร:</label>
                    <input type="number" id="feeding" name="feeding" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="bathing">การอาบน้ำ:</label>
                    <input type="number" id="bathing" name="bathing" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="grooming">การดูแลความสะอาด:</label>
                    <input type="number" id="grooming" name="grooming" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="dressing">การแต่งตัว:</label>
                    <input type="number" id="dressing" name="dressing" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="bowel_control">การควบคุมการขับถ่าย:</label>
                    <input type="number" id="bowel_control" name="bowel_control" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="bladder_control">การควบคุมปัสสาวะ:</label>
                    <input type="number" id="bladder_control" name="bladder_control" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="toilet_use">การใช้ห้องน้ำ:</label>
                    <input type="number" id="toilet_use" name="toilet_use" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="transfers">การย้ายตำแหน่ง:</label>
                    <input type="number" id="transfers" name="transfers" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="mobility">การเคลื่อนที่:</label>
                    <input type="number" id="mobility" name="mobility" min="0" max="10" required>
                </div>
                <div class="score">
                    <label for="stairs">การขึ้นลงบันได:</label>
                    <input type="number" id="stairs" name="stairs" min="0" max="10" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">ส่งแบบประเมิน</button>
        </form>
    </div>

</body>

</html>  --}}



