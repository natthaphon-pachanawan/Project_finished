<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Care Giver</title>
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
        document.addEventListener('DOMContentLoaded', function() {
            fetchElderlyDetails();
        });

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

        function showAssessmentForm() {
            document.getElementById('caregiver-form').classList.add('hidden');
            document.getElementById('assessment-form').classList.remove('hidden');
        }

        function showCareGiverForm() {
            document.getElementById('assessment-form').classList.add('hidden');
            document.getElementById('caregiver-form').classList.remove('hidden');
        }

        function transferValues() {
            document.getElementById('Name_CG_hidden').value = document.getElementById('Name_CG').value;
            document.getElementById('ID_Elderly_hidden').value = document.getElementById('ID_Elderly').value;
            document.getElementById('Age_hidden').value = document.getElementById('Age').value;
            document.getElementById('Address_hidden').value = document.getElementById('Address').value;
            document.getElementById('Weight_hidden').value = document.getElementById('Weight').value;
            document.getElementById('Height_hidden').value = document.getElementById('Height').value;
            document.getElementById('Waist_hidden').value = document.getElementById('Waist').value;
            document.getElementById('Group_ADL_hidden').value = document.getElementById('Group_ADL').value;
            document.getElementById('Disease_hidden').value = document.getElementById('Disease').value;
            document.getElementById('Disability_hidden').value = document.getElementById('Disability').value;
            document.getElementById('Rights_hidden').value = document.getElementById('Rights').value;
            document.getElementById('Caretaker_hidden').value = document.getElementById('Caretaker').value;
            document.getElementById('Related_hidden').value = document.getElementById('Related').value;
            document.getElementById('Phone_Caretaker_hidden').value = document.getElementById('Phone_Caretaker').value;
            document.getElementById('Name_Elderly_hidden').value = document.getElementById('Name_Elderly').value;
        }
    </script>
</head>

<body>
    @include('layout.nav')

    <div class="container">
        <h1>แก้ไขแบบฟอร์มรายงานผลการปฏิบัติงานผู้ดูแลผู้สูงอายุ (CG)</h1>
        @if (session('success'))
            <div style="color: green; margin-bottom: 20px;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="color: red; margin-bottom: 20px;">{{ session('error') }}</div>
        @endif

        <!-- Care Giver Form -->
        <form id="caregiver-form" action="javascript:void(0);" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="Name_CG">ชื่อผู้ดูแลผู้สูงอายุ</label>
                <input type="text" id="Name_CG" name="Name_CG" value="{{ $caregiver->Name_CG }}" required>
            </div>
            <div>
                <label for="Name_Elderly">ชื่อ-สกุลผู้สูงอายุ</label>
                <input type="text" id="Name_Elderly" name="Name_Elderly" value="{{ $caregiver->Name_Elderly }}" readonly>
                <input type="hidden" id="ID_Elderly" name="ID_Elderly" value="{{ $caregiver->ID_Elderly }}">
            </div>
            <div>
                <label for="Age">อายุ</label>
                <input type="number" id="Age" name="Age" value="{{ $caregiver->age }}" required readonly>
            </div>
            <div>
                <label for="Address">ที่อยู่</label>
                <input type="text" id="Address" name="Address" value="{{ $caregiver->Address }}" required readonly>
            </div>
            <div>
                <label for="Weight">น้ำหนักตัว</label>
                <input type="number" id="Weight" name="Weight" step="0.1" value="{{ $caregiver->Weight }}" required>
            </div>
            <div>
                <label for="Height">ส่วนสูง</label>
                <input type="number" id="Height" name="Height" step="0.1" value="{{ $caregiver->Height }}" required>
            </div>
            <div>
                <label for="Waist">รอบเอว</label>
                <input type="number" id="Waist" name="Waist" step="0.1" value="{{ $caregiver->Waist }}" required>
            </div>
            <div>
                <label for="Group_ADL">ประเภทผู้สูงอายุ</label>
                <input type="text" id="Group_ADL" name="Group_ADL" value="{{ $caregiver->Group_ADL }}" readonly required>
            </div>
            <div>
                <label for="Disease">โรคประจำตัว</label>
                <input type="text" id="Disease" name="Disease" value="{{ $caregiver->Disease }}">
            </div>
            <div>
                <label for="Disability">ความพิการ</label>
                <input type="text" id="Disability" name="Disability" value="{{ $caregiver->Disability }}">
            </div>
            <div>
                <label for="Rights">สิทธิการรักษา</label>
                <input type="text" id="Rights" name="Rights" value="{{ $caregiver->Rights }}">
            </div>
            <div>
                <label for="Caretaker">ชื่อ-สกุลผู้ดูแล</label>
                <input type="text" id="Caretaker" name="Caretaker" value="{{ $caregiver->Caretaker }}" required>
            </div>
            <div>
                <label for="Related">เกี่ยวข้องเป็น</label>
                <input type="text" id="Related" name="Related" value="{{ $caregiver->Related }}" required>
            </div>
            <div>
                <label for="Phone_Caretaker">เบอร์ติดต่อ</label>
                <input type="text" id="Phone_Caretaker" name="Phone_Caretaker" value="{{ $caregiver->Phone_Caretaker }}" required>
            </div>
            <input type="hidden" id="ID_ADL" name="ID_ADL" value="{{ $caregiver->ID_ADL }}">
            <input type="hidden" id="Name_Elderly_hidden" name="Name_Elderly" value="{{ $caregiver->Name_Elderly }}">

            <button type="button" onclick="transferValues(); showAssessmentForm();">ถัดไป</button>
            <a href="{{ route('cg.index') }}" class="back-button">กลับไปหน้าหลัก</a>
        </form>

        <!-- Assessment Form -->
        <form id="assessment-form" class="hidden" action="{{ route('cg.update', $caregiver->ID_CG) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Hidden fields to pass caregiver form data -->
            <input type="hidden" id="Name_CG_hidden" name="Name_CG" value="{{ $caregiver->Name_CG }}">
            <input type="hidden" id="ID_Elderly_hidden" name="ID_Elderly" value="{{ $caregiver->ID_Elderly }}">
            <input type="hidden" id="Age_hidden" name="Age" value="{{ $caregiver->Age }}">
            <input type="hidden" id="Address_hidden" name="Address" value="{{ $caregiver->Address }}">
            <input type="hidden" id="Weight_hidden" name="Weight" value="{{ $caregiver->Weight }}">
            <input type="hidden" id="Height_hidden" name="Height" value="{{ $caregiver->Height }}">
            <input type="hidden" id="Waist_hidden" name="Waist" value="{{ $caregiver->Waist }}">
            <input type="hidden" id="Group_ADL_hidden" name="Group_ADL" value="{{ $caregiver->Group_ADL }}">
            <input type="hidden" id="Disease_hidden" name="Disease" value="{{ $caregiver->Disease }}">
            <input type="hidden" id="Disability_hidden" name="Disability" value="{{ $caregiver->Disability }}">
            <input type="hidden" id="Rights_hidden" name="Rights" value="{{ $caregiver->Rights }}">
            <input type="hidden" id="Caretaker_hidden" name="Caretaker" value="{{ $caregiver->Caretaker }}">
            <input type="hidden" id="Related_hidden" name="Related" value="{{ $caregiver->Related }}">
            <input type="hidden" id="Phone_Caretaker_hidden" name="Phone_Caretaker" value="{{ $caregiver->Phone_Caretaker }}">
            <input type="hidden" id="Name_Elderly_hidden" name="Name_Elderly" value="{{ $caregiver->Name_Elderly }}">
            <!-- End hidden fields -->
            <div>
                <label for="Date">ว/ด/ป</label>
                <input type="date" id="Date" name="Date" value="{{ $caregiver->Date_CG }}" required>
            </div>
            <div>
                <label for="Consciousness">ความรู้สึกตัว</label>
                <select id="Consciousness" name="Consciousness" required>
                    <option value="รู้สึกดี" {{ $caregiver->Consciousness == 'รู้สึกดี' ? 'selected' : '' }}>รู้สึกดี</option>
                    <option value="ไม่รู้สึกตัว" {{ $caregiver->Consciousness == 'ไม่รู้สึกตัว' ? 'selected' : '' }}>ไม่รู้สึกตัว</option>
                </select>
            </div>
            <div>
                <label for="Vital_signs">สัญญาณชีพ</label>
                <input type="text" id="Vital_signs" name="Vital_signs" value="{{ $caregiver->Vital_signs }}" required placeholder="BP… PR… RR…. BT…">
            </div>
            <div>
                <label for="Bedsores">แผลกดทับ</label>
                <select id="Bedsores" name="Bedsores" required>
                    <option value="ไม่มี" {{ $caregiver->Bedsores == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Bedsores == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Bedsores_details" name="Bedsores_details" value="{{ $caregiver->Bedsores_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Pain">อาการปวด</label>
                <select id="Pain" name="Pain" required>
                    <option value="ไม่มี" {{ $caregiver->Pain == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Pain == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Pain_details" name="Pain_details" value="{{ $caregiver->Pain_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Swelling">อาการบวม</label>
                <select id="Swelling" name="Swelling" required>
                    <option value="ไม่มี" {{ $caregiver->Swelling == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Swelling == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Swelling_details" name="Swelling_details" value="{{ $caregiver->Swelling_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Itchy_rash">ผื่นคัน</label>
                <select id="Itchy_rash" name="Itchy_rash" required>
                    <option value="ไม่มี" {{ $caregiver->Itchy_rash == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Itchy_rash == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Itchy_rash_details" name="Itchy_rash_details" value="{{ $caregiver->Itchy_rash_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Stiff_joints">ข้อติดแข็ง</label>
                <select id="Stiff_joints" name="Stiff_joints" required>
                    <option value="ไม่มี" {{ $caregiver->Stiff_joints == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Stiff_joints == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Stiff_joints_details" name="Stiff_joints_details" value="{{ $caregiver->Stiff_joints_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Malnutrition">ทุพโภชนาการ</label>
                <select id="Malnutrition" name="Malnutrition" required>
                    <option value="ไม่มี" {{ $caregiver->Malnutrition == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Malnutrition == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Malnutrition_details" name="Malnutrition_details" value="{{ $caregiver->Malnutrition_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Eating">การรับประทานอาหาร</label>
                <select id="Eating" name="Eating" required>
                    <option value="ตักกินเองได้" {{ $caregiver->Eating == 'ตักกินเองได้' ? 'selected' : '' }}>ตักกินเองได้</option>
                    <option value="กินเองไม่ได้" {{ $caregiver->Eating == 'กินเองไม่ได้' ? 'selected' : '' }}>กินเองไม่ได้</option>
                </select>
            </div>
            <div>
                <label for="Swallowing">การกลืน</label>
                <select id="Swallowing" name="Swallowing" required>
                    <option value="กลืนได้ปกติ" {{ $caregiver->Swallowing == 'กลืนได้ปกติ' ? 'selected' : '' }}>กลืนได้ปกติ</option>
                    <option value="สำลัก" {{ $caregiver->Swallowing == 'สำลัก' ? 'selected' : '' }}>สำลัก</option>
                </select>
            </div>
            <div>
                <label for="Defecation">การขับถ่ายอุจจาระ</label>
                <select id="Defecation" name="Defecation" required>
                    <option value="กลั้นได้" {{ $caregiver->Defecation == 'กลั้นได้' ? 'selected' : '' }}>กลั้นได้</option>
                    <option value="กลั้นไม่ได้" {{ $caregiver->Defecation == 'กลั้นไม่ได้' ? 'selected' : '' }}>กลั้นไม่ได้</option>
                </select>
            </div>
            <div>
                <label for="Urinary_excretion">การขับถ่ายปัสสาวะ</label>
                <select id="Urinary_excretion" name="Urinary_excretion" required>
                    <option value="กลั้นได้" {{ $caregiver->Urinary_excretion == 'กลั้นได้' ? 'selected' : '' }}>กลั้นได้</option>
                    <option value="กลั้นไม่ได้" {{ $caregiver->Urinary_excretion == 'กลั้นไม่ได้' ? 'selected' : '' }}>กลั้นไม่ได้</option>
                </select>
            </div>
            <div>
                <label for="Taking_medicine">การรับประทานยา</label>
                <select id="Taking_medicine" name="Taking_medicine" required>
                    <option value="กินสม่ำเสมอ" {{ $caregiver->Taking_medicine == 'กินสม่ำเสมอ' ? 'selected' : '' }}>กินสม่ำเสมอ</option>
                    <option value="ขาดยา" {{ $caregiver->Taking_medicine == 'ขาดยา' ? 'selected' : '' }}>ขาดยา</option>
                </select>
            </div>
            <div>
                <label for="Emotional_state">สภาพอารมณ์</label>
                <select id="Emotional_state" name="Emotional_state" required>
                    <option value="ปกติ" {{ $caregiver->Emotional_state == 'ปกติ' ? 'selected' : '' }}>ปกติ</option>
                    <option value="ผิดปกติ" {{ $caregiver->Emotional_state == 'ผิดปกติ' ? 'selected' : '' }}>ผิดปกติ</option>
                </select>
            </div>
            <div>
                <label for="Economic_problems">ปัญหาเศรษฐกิจ</label>
                <select id="Economic_problems" name="Economic_problems" required>
                    <option value="ไม่มี" {{ $caregiver->Economic_problems == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Economic_problems == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Economic_problems_details" name="Economic_problems_details" value="{{ $caregiver->Economic_problems_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Social_problems">ปัญหาสังคม</label>
                <select id="Social_problems" name="Social_problems" required>
                    <option value="ไม่มี" {{ $caregiver->Social_problems == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Social_problems == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Social_problems_details" name="Social_problems_details" value="{{ $caregiver->Social_problems_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Doctor_FU">แพทย์นัด F/U</label>
                <select id="Doctor_FU" name="Doctor_FU" required>
                    <option value="ไม่มี" {{ $caregiver->Doctor_FU == 'ไม่มี' ? 'selected' : '' }}>ไม่มี</option>
                    <option value="มี" {{ $caregiver->Doctor_FU == 'มี' ? 'selected' : '' }}>มี</option>
                </select>
                <input type="text" id="Doctor_FU_details" name="Doctor_FU_details" value="{{ $caregiver->Doctor_FU_details }}" placeholder="รายละเอียดถ้ามี">
            </div>
            <div>
                <label for="Other_problems">ปัญหาอื่น ๆ</label>
                <input type="text" id="Other_problems" name="Other_problems" value="{{ $caregiver->Other_problems }}">
            </div>
            <div>
                <label for="Assistance">การช่วยเหลือ</label>
                <input type="text" id="Assistance" name="Assistance" value="{{ $caregiver->Assistance }}">
            </div>
            <div>
                <label for="Reporter">ผู้รายงาน</label>
                <input type="text" id="Reporter" name="Reporter" value="{{ Auth::user()->Name_User }}" readonly required>
            </div>
            <button type="button" onclick="showCareGiverForm()">กลับ</button>
            <button type="submit">บันทึก</button>
        </form>
    </div>
</body>

</html>
