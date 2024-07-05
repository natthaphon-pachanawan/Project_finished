<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea,
        input[type="date"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button,
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .btn-primary {
            background: #3498db;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-secondary {
            background: #007BFF;
        }

        .btn-secondary:hover {
            background: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input[type="radio"] {
            margin-right: 10px;
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
        <h1>แก้ไขแบบฟอร์มกิจกรรมการดูแลผู้สงอายุ (ACG)</h1>
        @if (session('success'))
        <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div style="color: red; margin-bottom: 20px;">{{ session('error') }}</div>
        @endif

        <!-- Activity Form -->
        <form id="activity-form" action="{{ route('acg.update', ['id' => $activity->ID_ACG]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="ID_Elderly">ชื่อ-สกุลผู้สูงอายุ</label>
                <input type="text" id="Name_Elderly" name="Name_Elderly" class="form-control" value="{{ $activity->caregiver->Name_Elderly }}" readonly>
            </div>
            <div class="form-group">
                <label for="activity_date">กิจกรรมการดูแลผู้สูงอายุ</label>
                <input type="date" id="activity_date" name="activity_date" class="form-control" value="{{ $activity->Date_ACG }}" required>
            </div>

            <h4>กิจกรรมด้านสาธารณสุข</h4>
            <div class="form-group">
                <label for="evaluate">ประเมิน/ติดตามอาการ</label>
                <input type="text" id="evaluate" name="evaluate" class="form-control" value="{{ $activity->Evaluate }}">
            </div>
            <div class="form-group">
                <label>ทำแผล</label>
                <div>
                    <input type="radio" id="dress_the_wound_help" name="dress_the_wound" value="ช่วยเหลือ" {{ $activity->Dress_the_wound == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="dress_the_wound_no_help" name="dress_the_wound" value="ไม่ต้องช่วยเหลือ" {{ $activity->Dress_the_wound == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                </div>
            </div>
            <div class="form-group">
                <label>ฟื้นฟูสภาพฯ</label>
                <div>
                    <input type="radio" id="rehabilitate_help" name="rehabilitate" value="ช่วยเหลือ" {{ $activity->Rehabilitate == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="rehabilitate_no_help" name="rehabilitate" value="ไม่ต้องช่วยเหลือ" {{ $activity->Rehabilitate == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                    <input type="radio" id="rehabilitate_cannot" name="rehabilitate" value="ไม่สามารถไปได้" {{ $activity->Rehabilitate == 'ไม่สามารถไปได้' ? 'checked' : '' }}> ไม่สามารถไปได้
                </div>
            </div>
            <div class="form-group">
                <label>ทำความสะอาดร่างกาย</label>
                <div>
                    <input type="radio" id="clean_body_help" name="clean_body" value="ช่วยเหลือ" {{ $activity->Clean_body == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="clean_body_no_help" name="clean_body" value="ไม่ต้องช่วยเหลือ" {{ $activity->Clean_body == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                </div>
            </div>
            <div class="form-group">
                <label>ดูแลเรื่องยา</label>
                <div>
                    <input type="radio" id="take_care_medicine_help" name="take_care_medicine" value="ช่วยเหลือ" {{ $activity->Take_care_medicine == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_care_medicine_no_help" name="take_care_medicine" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_care_medicine == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                </div>
            </div>
            <div class="form-group">
                <label>ดูแลให้อาหาร</label>
                <div>
                    <input type="radio" id="take_care_feeding_help" name="take_care_feeding" value="ช่วยเหลือ" {{ $activity->Take_care_feeding == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_care_feeding_no_help" name="take_care_feeding" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_care_feeding == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                </div>
            </div>
            <div class="form-group">
                <label>การจัดสิ่งแวดล้อม</label>
                <div>
                    <input type="radio" id="environmental_help" name="environmental" value="ช่วยเหลือ" {{ $activity->Environmental == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="environmental_no_help" name="environmental" value="ไม่ต้องช่วยเหลือ" {{ $activity->Environmental == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                </div>
            </div>
            <div class="form-group">
                <label>พาออกกำลังกาย</label>
                <div>
                    <input type="radio" id="take_exercise_help" name="take_exercise" value="ช่วยเหลือ" {{ $activity->Take_exercise == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_exercise_no_help" name="take_exercise" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_exercise == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                    <input type="radio" id="take_exercise_cannot" name="take_exercise" value="ไม่สามารถไปได้" {{ $activity->Take_exercise == 'ไม่สามารถไปได้' ? 'checked' : '' }}> ไม่สามารถไปได้
                </div>
            </div>
            <div class="form-group">
                <label>ให้คำแนะนำ/ปรึกษา</label>
                <div>
                    <input type="radio" id="give_advice_consult_help" name="give_advice_consult" value="ช่วยเหลือ" {{ $activity->Give_advice_consult == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="give_advice_consult_no_help" name="give_advice_consult" value="ไม่ต้องช่วยเหลือ" {{ $activity->Give_advice_consult == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                </div>
            </div>
            <div class="form-group">
                <label>พาพบแพทย์</label>
                <div>
                    <input type="radio" id="take_to_see_a_doctor_help" name="take_to_see_a_doctor" value="ช่วยเหลือ" {{ $activity->Take_to_see_a_doctor == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_to_see_a_doctor_no_help" name="take_to_see_a_doctor" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_to_see_a_doctor == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                    <input type="radio" id="take_to_see_a_doctor_cannot" name="take_to_see_a_doctor" value="ไม่สามารถไปได้" {{ $activity->Take_to_see_a_doctor == 'ไม่สามารถไปได้' ? 'checked' : '' }}> ไม่สามารถไปได้
                </div>
            </div>
            <div class="form-group">
                <label for="other_specified">อื่น ๆ ระบุ</label>
                <input type="text" id="other_specified" name="other_specified" class="form-control" value="{{ $activity->Other }}">
            </div>

            <h4>กิจกรรมด้านสังคม</h4>
            <div class="form-group">
                <label>พาไปทำบุญ</label>
                <div>
                    <input type="radio" id="take_to_make_merit_help" name="take_to_make_merit" value="ช่วยเหลือ" {{ $activity->Take_to_make_merit == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_to_make_merit_no_help" name="take_to_make_merit" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_to_make_merit == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                    <input type="radio" id="take_to_make_merit_cannot" name="take_to_make_merit" value="ไม่สามารถไปได้" {{ $activity->Take_to_make_merit == 'ไม่สามารถไปได้' ? 'checked' : '' }}> ไม่สามารถไปได้
                </div>
            </div>
            <div class="form-group">
                <label>พาไปจ่ายตลาด</label>
                <div>
                    <input type="radio" id="take_to_market_help" name="take_to_market" value="ช่วยเหลือ" {{ $activity->Take_to_market == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_to_market_no_help" name="take_to_market" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_to_market == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                    <input type="radio" id="take_to_market_cannot" name="take_to_market" value="ไม่สามารถไปได้" {{ $activity->Take_to_market == 'ไม่สามารถไปได้' ? 'checked' : '' }}> ไม่สามารถไปได้
                </div>
            </div>
            <div class="form-group">
                <label>พาไปพบเพื่อน</label>
                <div>
                    <input type="radio" id="take_to_meet_friends_help" name="take_to_meet_friends" value="ช่วยเหลือ" {{ $activity->Take_to_meet_friends == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_to_meet_friends_no_help" name="take_to_meet_friends" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_to_meet_friends == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                    <input type="radio" id="take_to_meet_friends_cannot" name="take_to_meet_friends" value="ไม่สามารถไปได้" {{ $activity->Take_to_meet_friends == 'ไม่สามารถไปได้' ? 'checked' : '' }}> ไม่สามารถไปได้
                </div>
            </div>
            <div class="form-group">
                <label>พาไปรับเบี้ย</label>
                <div>
                    <input type="radio" id="take_to_allowance_help" name="take_to_allowance" value="ช่วยเหลือ" {{ $activity->Take_to_allowance == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="take_to_allowance_no_help" name="take_to_allowance" value="ไม่ต้องช่วยเหลือ" {{ $activity->Take_to_allowance == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                    <input type="radio" id="take_to_allowance_cannot" name="take_to_allowance" value="ไม่สามารถไปได้" {{ $activity->Take_to_allowance == 'ไม่สามารถไปได้' ? 'checked' : '' }}> ไม่สามารถไปได้
                </div>
            </div>
            <div class="form-group">
                <label>พูดคุยเป็นเพื่อน</label>
                <div>
                    <input type="radio" id="talk_as_friends_help" name="talk_as_friends" value="ช่วยเหลือ" {{ $activity->Talk_as_friends == 'ช่วยเหลือ' ? 'checked' : '' }}> ช่วยเหลือ
                    <input type="radio" id="talk_as_friends_no_help" name="talk_as_friends" value="ไม่ต้องช่วยเหลือ" {{ $activity->Talk_as_friends == 'ไม่ต้องช่วยเหลือ' ? 'checked' : '' }}> ไม่ต้องช่วยเหลือ
                </div>
            </div>
            <div class="form-group">
                <label for="other_social_specified">อื่น ๆ ระบุ</label>
                <input type="text" id="other_social_specified" name="other_social_specified" class="form-control" value="{{ $activity->Other_specified }}">
            </div>

            <div class="form-group">
                <label for="problems_found">ปัญหาที่พบ</label>
                <textarea id="problems_found" name="problems_found" class="form-control" rows="5">{{ $activity->Problem }}</textarea>
            </div>
            <div class="form-group">
                <label for="solutions">การช่วยเหลือ/ แนวทางการแก้ไขปัญหา</label>
                <textarea id="solutions" name="solutions" class="form-control" rows="5">{{ $activity->Troubleshoot }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">บันทึก</button>
            <a href="{{ route('acg.index') }}" class="btn btn-secondary">กลับไปหน้า ACG</a>
        </form>
    </div>
</body>

</html>
