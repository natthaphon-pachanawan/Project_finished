<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานกิจกรรมการดูแลผู้สูงอายุ</title>
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
            font-size: 14px;
            color: #333;
            background-color: #fff;
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
            color: #333;
        }

        .section-title {
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .info {
            margin-bottom: 15px;
        }

        .info label {
            font-weight: bold;
        }

        .info span {
            display: block;
            margin-top: 5px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>รายงานกิจกรรมการดูแลผู้สูงอายุ</h1>

        <div class="section-title">ข้อมูลทั่วไป</div>
        <table>
            <tr>
                <th>ชื่อผู้สูงอายุ</th>
                <td>{{ $activity->caregiver->Name_Elderly }}</td>
            </tr>
            <tr>
                <th>ชื่อผู้ดูแลผู้สูงอายุ</th>
                <td>{{ $activity->caregiver->Name_CG }}</td>
            </tr>
            <tr>
                <th>วันที่ทำกิจกรรม</th>
                <td>{{ $activity->Date_ACG }}</td>
            </tr>
        </table>

        <div class="section-title">กิจกรรมด้านสาธารณสุข</div>
        <table>
            <tr>
                <th>ประเมิน/ติดตามอาการ</th>
                <td>{{ $activity->Evaluate ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>ทำแผล</th>
                <td>{{ $activity->Dress_the_wound ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>ฟื้นฟูสภาพฯ</th>
                <td>{{ $activity->Rehabilitate ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>ทำความสะอาดร่างกาย</th>
                <td>{{ $activity->Clean_body ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>ดูแลเรื่องยา</th>
                <td>{{ $activity->Take_care_medicine ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>ดูแลให้อาหาร</th>
                <td>{{ $activity->Take_care_feeding ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>การจัดสิ่งแวดล้อม</th>
                <td>{{ $activity->Environmental ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>พาออกกำลังกาย</th>
                <td>{{ $activity->Take_exercise ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>ให้คำแนะนำ/ปรึกษา</th>
                <td>{{ $activity->Give_advice_consult ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>พาพบแพทย์</th>
                <td>{{ $activity->Take_to_see_a_doctor ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>อื่น ๆ ระบุ</th>
                <td>{{ $activity->Other ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
        </table>

        <div class="section-title page-break">กิจกรรมด้านสังคม</div>
        <table>
            <tr>
                <th>พาไปทำบุญ</th>
                <td>{{ $activity->Take_to_make_merit ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>พาไปจ่ายตลาด</th>
                <td>{{ $activity->Take_to_market ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>พาไปพบเพื่อน</th>
                <td>{{ $activity->Take_to_meet_friends ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>พาไปรับเบี้ย</th>
                <td>{{ $activity->Take_to_allowance ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>พูดคุยเป็นเพื่อน</th>
                <td>{{ $activity->Talk_as_friends ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>อื่น ๆ ระบุ</th>
                <td>{{ $activity->Other_specified ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
        </table>

        <div class="section-title">ปัญหาที่พบและการช่วยเหลือ</div>
        <table>
            <tr>
                <th>ปัญหาที่พบ</th>
                <td>{{ $activity->Problem ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>การช่วยเหลือ/แนวทางการแก้ไขปัญหา</th>
                <td>{{ $activity->Troubleshoot ?? 'ไม่มีข้อมูล' }}</td>
            </tr>
        </table>
    </div>
    <script>
        window.onafterprint = function () {
            window.history.back();
        };

        setTimeout(function () {
            window.print();
        }, 1000);
    </script>
</body>

</html>
