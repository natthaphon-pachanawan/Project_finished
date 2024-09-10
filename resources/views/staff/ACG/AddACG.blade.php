<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Activity</title>
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

        .hidden {
            display: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input[type="checkbox"] {
            margin-right: 10px;
        }
    </style>
    <script>
        function handleCheckboxValues(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const form = event.target; // Get the form element

            checkboxes.forEach(function (checkbox) {
                if (!checkbox.checked) {
                    checkbox.value = "-";
                    checkbox.checked = true;
                }
            });

            // Hide all checkboxes momentarily while form is being submitted
            checkboxes.forEach(checkbox => checkbox.style.visibility = "hidden");

            // Submit the form after processing checkbox values
            form.submit();
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('activity-form').addEventListener('submit', handleCheckboxValues);
        });
    </script>
</head>

<body>
    @include('layout.nav')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1>แบบฟอร์มกิจกรรมการดูแลผู้สงอายุ (ACG)</h1>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Activity Form -->
                    <form id="activity-form" action="{{ route('activities.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="ID_Elderly">ชื่อ-สกุลผู้สูงอายุ</label>
                            <select id="ID_Elderly" name="ID_Elderly" class="form-control"
                                onchange="fetchElderlyDetails()" required>
                                <option value="">เลือกผู้สูงอายุ</option>
                                @foreach ($elderlys as $elderly)
                                    <option value="{{ $elderly->ID_Elderly }}">{{ $elderly->Name_Elderly }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="activity_date">ลงเวลากิจกรรมการดูแลผู้สูงอายุ</label>
                            <input type="date" id="activity_date" name="activity_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="evaluate">ประเมิน/ติดตามอาการ</label>
                            <select id="evaluate" name="evaluate" class="form-control" required>
                                <option value="">-- กรุณาเลือก --</option>
                                <option value="ประเมิน">ประเมิน</option>
                                <option value="ติดตามอาการ">ติดตามอาการ</option>
                            </select>
                        </div>

                        <h4>กิจกรรมด้านสาธารณสุข</h4>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="ทำแผล" id="dress_the_wound" name="dress_the_wound">
                                <label class="form-check-label" for="dress_the_wound">ทำแผล</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="ฟื้นฟูสภาพฯ" id="rehabilitate" name="rehabilitate">
                                <label class="form-check-label" for="rehabilitate">ฟื้นฟูสภาพฯ</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="ทำความสะอาดร่างกาย" id="clean_body" name="clean_body">
                                <label class="form-check-label" for="clean_body">ทำความสะอาดร่างกาย</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="ดูแลเรื่องยา" id="take_care_medicine" name="take_care_medicine">
                                <label class="form-check-label" for="take_care_medicine">ดูแลเรื่องยา</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="ดูแลให้อาหาร" id="take_care_feeding" name="take_care_feeding">
                                <label class="form-check-label" for="take_care_feeding">ดูแลให้อาหาร</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="การจัดสิ่งแวดล้อม" id="environmental" name="environmental">
                                <label class="form-check-label" for="environmental">การจัดสิ่งแวดล้อม</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="พาออกกำลังกาย" id="take_exercise" name="take_exercise">
                                <label class="form-check-label" for="take_exercise">พาออกกำลังกาย</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="ให้คำแนะนำ/ปรึกษา" id="give_advice_consult" name="give_advice_consult">
                                <label class="form-check-label" for="give_advice_consult">ให้คำแนะนำ/ปรึกษา</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="พาพบแพทย์" id="take_to_see_a_doctor" name="take_to_see_a_doctor">
                                <label class="form-check-label" for="take_to_see_a_doctor">พาพบแพทย์</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="other_specified">อื่น ๆ ระบุ</label>
                            <input type="text" id="other_specified" name="other_specified" class="form-control">
                        </div>

                        <h4>กิจกรรมด้านสังคม</h4>
                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="พาไปทำบุญ" id="take_to_make_merit" name="take_to_make_merit">
                                <label class="form-check-label" for="take_to_make_merit">พาไปทำบุญ</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="พาไปจ่ายตลาด" id="take_to_market" name="take_to_market">
                                <label class="form-check-label" for="take_to_market">พาไปจ่ายตลาด</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="พาไปพบเพื่อน" id="take_to_meet_friends" name="take_to_meet_friends">
                                <label class="form-check-label" for="take_to_meet_friends">พาไปพบเพื่อน</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="พาไปรับเบี้ย" id="take_to_allowance" name="take_to_allowance">
                                <label class="form-check-label" for="take_to_allowance">พาไปรับเบี้ย</label>
                            </div>
                        </div>

                        <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="พูดคุยเป็นเพื่อน" id="talk_as_friends" name="talk_as_friends">
                                <label class="form-check-label" for="talk_as_friends">พูดคุยเป็นเพื่อน</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="other_social_specified">อื่น ๆ ระบุ</label>
                            <input type="text" id="other_social_specified" name="other_social_specified"
                                class="form-control">
                        </div>

                        
                        <button class="btn btn-primary" type="submit">บันทึก</button>
                        <a href="{{ route('acg.index') }}" class="btn btn-secondary">กลับไปหน้า ACG</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
