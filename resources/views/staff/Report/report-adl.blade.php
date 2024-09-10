<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน ADL</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <style>
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 10mm;
            font-family: Arial, sans-serif;
            font-size: 12px;
            box-sizing: border-box;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-inside: avoid;
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

        .questions {
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .questions table {
            width: 100%;
            border-collapse: collapse;
        }

        .questions th,
        .questions td {
            border: 1px solid black;
            padding: 8px;
        }

        .questions th {
            background-color: #f2f2f2;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>รายงาน ADL</h1>
        <table>
            <tr>
                <th>ชื่อผู้สูงอายุ</th>
                <td>{{ $adl->elderly ? $adl->elderly->Name_Elderly : 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>ชื่อเจ้าหน้าที่ผู้รับผิดชอบ</th>
                <td>{{ $adl->Name_User ?: 'ไม่มีข้อมูล' }}</td>
            </tr>
            <tr>
                <th>กลุ่ม ADL</th>
                <td>{{ $adl->Group_ADL ?: 'ไม่มีข้อมูล' }}</td>
            </tr>
        </table>

        <div class="questions">
            <h3>โจทย์และคำตอบของแบบประเมิน ADL</h3>
            <table>
                <tr>
                    <th>ข้อคำถาม</th>
                    <th>คำตอบ</th>
                </tr>
                <tr>
                    <td>การรับประทานอาหาร</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('feeding', $adl->Feeding) }}</td>
                </tr>
                <tr>
                    <td>การดูแลร่างกาย</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('grooming', $adl->Grooming) }}</td>
                </tr>
                <tr>
                    <td>การย้ายตัว</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('transfer', $adl->Transfer) }}</td>
                </tr>
                <tr>
                    <td>การใช้ห้องน้ำ</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('toilet_use', $adl->Toilet_use) }}</td>
                </tr>
                <tr>
                    <td>การเคลื่อนที่ภายในห้องหรือบ้าน</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('mobility', $adl->Mobility) }}</td>
                </tr>
                <tr>
                    <td>การสวมใส่เสื้อผ้า</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('dressing', $adl->Dressing) }}</td>
                </tr>
                <tr>
                    <td>การขึ้นลงบันได 1 ชั้น</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('stairs', $adl->Stairs) }}</td>
                </tr>
                <tr>
                    <td>การอาบน้ำ</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('bathing', $adl->Bathing) }}</td>
                </tr>
                <tr>
                    <td>การกลั้นการถ่ายอุจจาระในระยะ 1 สัปดาห์ที่ผ่านมา</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('bowels', $adl->Bowels) }}</td>
                </tr>
                <tr>
                    <td>การกลั้นปัสสาวะในระยะ 1 สัปดาห์ที่ผ่านมา</td>
                    <td>{{ \App\Models\BarthelAdl::getAdlDescription('bladder', $adl->Bladder) }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
