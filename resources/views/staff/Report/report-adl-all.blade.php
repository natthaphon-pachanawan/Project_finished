<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูล ADL</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-after: always;
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

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>รายงานข้อมูล ADL</h1>
        <table>
            <thead>
                <tr>
                    <th>ชื่อผู้สูงอายุ</th>
                    <th>ชื่อเจ้าหน้าที่ผู้รับผิดชอบ</th>
                    <th>กลุ่ม ADL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($adls as $adl)
                    <tr>
                        <td>{{ $adl->elderly ? $adl->elderly->Name_Elderly : 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $adl->Name_User ?: 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $adl->Group_ADL ?: 'ไม่มีข้อมูล' }}</td>
                    </tr>
                    @if($loop->iteration % 20 == 0 && !$loop->last)
                        </tbody>
                    </table>
                    <div class="page-break"></div>
                    <table>
                    <thead>
                        <tr>
                            <th>ชื่อผู้สูงอายุ</th>
                            <th>ชื่อเจ้าหน้าที่ผู้รับผิดชอบ</th>
                            <th>กลุ่ม ADL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @endif
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
