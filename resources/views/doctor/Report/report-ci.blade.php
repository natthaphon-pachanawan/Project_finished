<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานคำแนะนำการดูแล</title>
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
        <h1>รายงานคำแนะนำการดูแล</h1>
        <table>
            <thead>
                <tr>
                    <th>วันที่</th>
                    <th>ชื่อผู้สูงอายุ</th>
                    <th>ชื่อหมอ</th>
                    <th>ชื่อเจ้าหน้าที่</th>
                    <th>คำแนะนำ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($careInstructions as $ci)
                <tr>
                    <td>{{ $ci->Date_CI }}</td>
                    <td>{{ $ci->Name_Elderly }}</td>
                    <td>{{ $ci->Name_Doctor }}</td>
                    <td>{{ $ci->Name_Staff }}</td>
                    <td>{{ $ci->Care_instructions }}</td>
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
