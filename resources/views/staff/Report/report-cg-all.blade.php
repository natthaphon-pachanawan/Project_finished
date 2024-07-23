<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน CG ทั้งหมด</title>
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

        th {
            background-color: #f2f2f2;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>รายงาน CG ทั้งหมด</h1>
        <table>
            <thead>
                <tr>
                    <th>วันที่</th>
                    <th>ชื่อผู้สูงอายุ</th>
                    <th>ชื่อผู้ดูแลผู้สูงอายุ</th>
                    <th>กลุ่ม ADL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cgs as $cg)
                    <tr>
                        <td>{{ $cg->Date_CG ?: 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $cg->Name_Elderly ?: 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $cg->Name_CG ?: 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $cg->Group_ADL ?: 'ไม่มีข้อมูล' }}</td>
                    </tr>
                @endforeach
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
