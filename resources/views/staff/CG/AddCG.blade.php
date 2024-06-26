<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Care Giver</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
    <script>
        function fetchGroupADL() {
            var elderlyId = document.getElementById('ID_Elderly').value;
            if (elderlyId) {
                fetch(`/get-group-adl/${elderlyId}`)
                    .then(response => response.json())
                    .then(data => {
                        var groupADLSelect = document.getElementById('Group_ADL');
                        groupADLSelect.innerHTML = '';
                        var option = document.createElement('option');
                        option.value = data.Group_ADL;
                        option.text = data.Group_ADL;
                        groupADLSelect.appendChild(option);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Add Care Giver</h1>
        @if(session('success'))
            <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        <form action="{{ route('caregivers.store') }}" method="POST">
            @csrf
            <div>
                <label for="Name_CG">ชื่อผู้ดูแลผู้สูงอายุ</label>
                <input type="text" id="Name_CG" name="Name_CG" required>
            </div>
            <div>
                <label for="ID_Elderly">ชื่อ-สกุลผู้สูงอายุ</label>
                <select id="ID_Elderly" name="ID_Elderly" onchange="fetchGroupADL()" required>
                    <option value="">Select Elderly</option>
                    @foreach($elderlies as $elderly)
                        <option value="{{ $elderly->ID_Elderly }}">{{ $elderly->Name_Elderly }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="Age">อายุ</label>
                <input type="number" id="Age" name="Age" required>
            </div>
            <div>
                <label for="Address">ที่อยู่</label>
                <input type="text" id="Address" name="Address" required>
            </div>
            <div>
                <label for="Weight">น้ำหนักตัว</label>
                <input type="number" id="Weight" name="Weight" step="0.1" required>
            </div>
            <div>
                <label for="Height">ส่วนสูง</label>
                <input type="number" id="Height" name="Height" step="0.1" required>
            </div>
            <div>
                <label for="Waist">รอบเอว</label>
                <input type="number" id="Waist" name="Waist" step="0.1" required>
            </div>
            <div>
                <label for="Group_ADL">ประเภทผู้สูงอายุ</label>
                <select id="Group_ADL" name="Group_ADL" required>
                    <!-- ตัวเลือกจะถูกเพิ่มโดย JavaScript -->
                </select>
            </div>
            <div>
                <label for="Disease">โรคประจำตัว</label>
                <input type="text" id="Disease" name="Disease">
            </div>
            <div>
                <label for="Disability">ความพิการ</label>
                <input type="text" id="Disability" name="Disability">
            </div>
            <div>
                <label for="Rights">สิทธิการรักษา</label>
                <input type="text" id="Rights" name="Rights">
            </div>
            <div>
                <label for="Caretaker">ชื่อ-สกุลผู้ดูแล</label>
                <input type="text" id="Caretaker" name="Caretaker" required>
            </div>
            <div>
                <label for="Related">เกี่ยวข้องเป็น</label>
                <input type="text" id="Related" name="Related" required>
            </div>
            <div>
                <label for="Phone_Caretaker">เบอร์ติดต่อ</label>
                <input type="text" id="Phone_Caretaker" name="Phone_Caretaker" required>
            </div>
            <button type="submit">บันทึก</button>
        </form>
    </div>
</body>
</html>
