<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Activity</title>
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

        input[type="text"],
        input[type="number"],
        select,
        textarea {
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

        .hidden {
            display: none;
        }
    </style>
    <script>
        function fetchElderlyDetails() {
            var elderlyId = document.getElementById('ID_Elderly').value;
            if (elderlyId) {
                fetch(`/get-elderly-details/${elderlyId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('Age').value = data.Age;
                        document.getElementById('Address').value = data.Address;
                        document.getElementById('Group_ADL').value = data.Group_ADL;
                        document.getElementById('Name_Elderly').value = document.getElementById('ID_Elderly').options[
                            document.getElementById('ID_Elderly').selectedIndex].text;
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
</head>

<body>

    @include('layout.nav')

    <div class="container">
        <h1>แบบฟอร์มกิจกรรมการดูแลผู้สงอายุ (ACG)</h1>
        @if (session('success'))
            <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="color: red; margin-bottom: 20px;">{{ session('error') }}</div>
        @endif

        <!-- Activity Form -->
        <form id="activity-form" action="{{ route('activities.store') }}" method="POST">
            @csrf
            <div>
                <label for="ID_Elderly">ชื่อ-สกุลผู้สูงอายุ</label>
                <select id="ID_Elderly" name="ID_Elderly" onchange="fetchElderlyDetails()" required>
                    <option value="">เลือกผู้สูงอายุ</option>
                    @foreach ($elderlys as $elderly)
                        <option value="{{ $elderly->ID_ADL }}">{{ $elderly->elderly->Name_Elderly }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="activity_date">ลงเวลากิจกรรมการดูแลผู้สูงอายุ</label>
                <input type="date" id="activity_date" name="activity_date" required>
            </div>

            <h4>กิจกรรมด้านสาธารณสุข</h4>
            <div>
                <label for="evaluate">ประเมิน/ติดตามอาการ</label>
                <input type="text" id="evaluate" name="evaluate">
            </div>
            <div>
                <label for="dress_the_wound">ทำแผล</label>
                <input type="radio" id="dress_the_wound_help" name="dress_the_wound" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="dress_the_wound_no_help" name="dress_the_wound" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
            </div>
            <div>
                <label for="rehabilitate">ฟื้นฟูสภาพฯ</label>
                <input type="radio" id="rehabilitate_help" name="rehabilitate" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="rehabilitate_no_help" name="rehabilitate" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
                <input type="radio" id="rehabilitate_cannot" name="rehabilitate" value="ไม่สามารถไปได้"> ไม่สามารถไปได้
            </div>
            <div>
                <label for="clean_body">ทำความสะอาดร่างกาย</label>
                <input type="radio" id="clean_body_help" name="clean_body" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="clean_body_no_help" name="clean_body" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
            </div>
            <div>
                <label for="take_care_medicine">ดูแลเรื่องยา</label>
                <input type="radio" id="take_care_medicine_help" name="take_care_medicine" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_care_medicine_no_help" name="take_care_medicine" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
            </div>
            <div>
                <label for="take_care_feeding">ดูแลให้อาหาร</label>
                <input type="radio" id="take_care_feeding_help" name="take_care_feeding" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_care_feeding_no_help" name="take_care_feeding" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
            </div>
            <div>
                <label for="environmental">การจัดสิ่งแวดล้อม</label>
                <input type="radio" id="environmental_help" name="environmental" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="environmental_no_help" name="environmental" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
            </div>
            <div>
                <label for="take_exercise">พาออกกำลังกาย</label>
                <input type="radio" id="take_exercise_help" name="take_exercise" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_exercise_no_help" name="take_exercise" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
                <input type="radio" id="take_exercise_cannot" name="take_exercise" value="ไม่สามารถไปได้"> ไม่สามารถไปได้
            </div>
            <div>
                <label for="give_advice_consult">ให้คำแนะนำ/ปรึกษา</label>
                <input type="radio" id="give_advice_consult_help" name="give_advice_consult" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="give_advice_consult_no_help" name="give_advice_consult" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
            </div>
            <div>
                <label for="take_to_see_a_doctor">พาพบแพทย์</label>
                <input type="radio" id="take_to_see_a_doctor_help" name="take_to_see_a_doctor" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_to_see_a_doctor_no_help" name="take_to_see_a_doctor" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
                <input type="radio" id="take_to_see_a_doctor_cannot" name="take_to_see_a_doctor" value="ไม่สามารถไปได้"> ไม่สามารถไปได้
            </div>
            <div>
                <label for="other_specified">อื่น ๆ ระบุ</label>
                <input type="text" id="other_specified" name="other_specified">
            </div>

            <h4>กิจกรรมด้านสังคม</h4>
            <div>
                <label for="take_to_make_merit">พาไปทำบุญ</label>
                <input type="radio" id="take_to_make_merit_help" name="take_to_make_merit" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_to_make_merit_no_help" name="take_to_make_merit" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
                <input type="radio" id="take_to_make_merit_cannot" name="take_to_make_merit" value="ไม่สามารถไปได้"> ไม่สามารถไปได้
            </div>
            <div>
                <label for="take_to_market">พาไปจ่ายตลาด</label>
                <input type="radio" id="take_to_market_help" name="take_to_market" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_to_market_no_help" name="take_to_market" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
                <input type="radio" id="take_to_market_cannot" name="take_to_market" value="ไม่สามารถไปได้"> ไม่สามารถไปได้
            </div>
            <div>
                <label for="take_to_meet_friends">พาไปพบเพื่อน</label>
                <input type="radio" id="take_to_meet_friends_help" name="take_to_meet_friends" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_to_meet_friends_no_help" name="take_to_meet_friends" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
                <input type="radio" id="take_to_meet_friends_cannot" name="take_to_meet_friends" value="ไม่สามารถไปได้"> ไม่สามารถไปได้
            </div>
            <div>
                <label for="take_to_allowance">พาไปรับเบี้ย</label>
                <input type="radio" id="take_to_allowance_help" name="take_to_allowance" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="take_to_allowance_no_help" name="take_to_allowance" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
                <input type="radio" id="take_to_allowance_cannot" name="take_to_allowance" value="ไม่สามารถไปได้"> ไม่สามารถไปได้
            </div>
            <div>
                <label for="talk_as_friends">พูดคุยเป็นเพื่อน</label>
                <input type="radio" id="talk_as_friends_help" name="talk_as_friends" value="ช่วยเหลือ"> ช่วยเหลือ
                <input type="radio" id="talk_as_friends_no_help" name="talk_as_friends" value="ไม่ต้องช่วยเหลือ"> ไม่ต้องช่วยเหลือ
            </div>
            <div>
                <label for="other_social_specified">อื่น ๆ ระบุ</label>
                <input type="text" id="other_social_specified" name="other_social_specified">
            </div>

            <div>
                <label for="problems_found">ปัญหาที่พบ</label>
                <textarea id="problems_found" name="problems_found" rows="5"></textarea>
            </div>
            <div>
                <label for="solutions">การช่วยเหลือ/ แนวทางการแก้ไขปัญหา</label>
                <textarea id="solutions" name="solutions" rows="5"></textarea>
            </div>
            <button type="submit">บันทึก</button>
            <a href="{{ route('acg.index') }}" class="back-button">กลับไปหน้า ACG</a>
        </form>
    </div>
</body>

</html>
