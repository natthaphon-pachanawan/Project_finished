<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน Care Giver รายบุคคล</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <style>
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 20mm;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            padding: 10mm;
            border: 1px solid #000;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section h2 {
            margin-bottom: 10px;
            font-size: 18px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
        }

        .info-section p {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>รายงาน Care Giver รายบุคคล</h1>
        <div class="info-section">
            <h2>ข้อมูลทั่วไป</h2>
            <p><strong>ชื่อผู้สูงอายุ:</strong> {{ $cg->elderly->Name_Elderly ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>ชื่อผู้ดูแลผู้สูงอายุ:</strong> {{ $cg->Name_CG ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>อายุ:</strong> {{ $cg->Age ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>ที่อยู่:</strong> {{ $cg->Address ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>น้ำหนักตัว:</strong> {{ $cg->Weight ?? 'ไม่มีข้อมูล' }} กก.</p>
            <p><strong>ส่วนสูง:</strong> {{ $cg->Height ?? 'ไม่มีข้อมูล' }} ซม.</p>
            <p><strong>รอบเอว:</strong> {{ $cg->Waist ?? 'ไม่มีข้อมูล' }} ซม.</p>
            <p><strong>กลุ่ม ADL:</strong> {{ $cg->Group_ADL ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>โรคประจำตัว:</strong> {{ $cg->Disease ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>ความพิการ:</strong> {{ $cg->Disability ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>สิทธิการรักษา:</strong> {{ $cg->Rights ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>ชื่อผู้ดูแล:</strong> {{ $cg->Caretaker ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>เกี่ยวข้องเป็น:</strong> {{ $cg->Related ?? 'ไม่มีข้อมูล' }}</p>
            <p><strong>เบอร์ติดต่อ:</strong> {{ $cg->Phone_Caretaker ?? 'ไม่มีข้อมูล' }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>คำถาม</th>
                    <th>คำตอบ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ว/ด/ป</td>
                    <td>{{ $cg->Date_CG ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ความรู้สึกตัว</td>
                    <td>{{ $cg->Consciousness ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>สัญญาณชีพ</td>
                    <td>{{ $cg->Vital_signs ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>แผลกดทับ</td>
                    <td>{{ $cg->Bedsores ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>อาการปวด</td>
                    <td>{{ $cg->Pain ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>อาการบวม</td>
                    <td>{{ $cg->Swelling ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ผื่นคัน</td>
                    <td>{{ $cg->Itchy_rash ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ข้อติดแข็ง</td>
                    <td>{{ $cg->Stiff_joints ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ทุพโภชนาการ</td>
                    <td>{{ $cg->Malnutrition ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>การรับประทานอาหาร</td>
                    <td>{{ $cg->Eating ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>การกลืน</td>
                    <td>{{ $cg->Swallowing ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>การขับถ่ายอุจจาระ</td>
                    <td>{{ $cg->Defecation ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>การขับถ่ายปัสสาวะ</td>
                    <td>{{ $cg->Urinary_excretion ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>การรับประทานยา</td>
                    <td>{{ $cg->Taking_medicine ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>สภาพอารมณ์</td>
                    <td>{{ $cg->Emotional_state ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ปัญหาเศรษฐกิจ</td>
                    <td>{{ $cg->Economic_problems ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ปัญหาสังคม</td>
                    <td>{{ $cg->Social_problems ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>แพทย์นัด F/U</td>
                    <td>{{ $cg->Doctor_FU ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ปัญหาอื่น ๆ</td>
                    <td>{{ $cg->Other_problems ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>การช่วยเหลือ</td>
                    <td>{{ $cg->Assistance ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
                <tr>
                    <td>ผู้รายงาน</td>
                    <td>{{ $cg->Reporter ?? 'ไม่มีข้อมูล' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        window.onafterprint = function() {
            window.history.back();
        };

        setTimeout(function() {
            window.print();
        }, 1000);
    </script>
</body>

</html>
