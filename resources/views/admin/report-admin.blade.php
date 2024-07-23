<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูลผู้ใช้</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <style>
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            padding: 10mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10mm;
            page-break-after: always;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>รายงานข้อมูลผู้ใช้</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>รูป</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>อีเมล</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>

                            <img src="{{ asset($user->Image_User) }}" alt="User Image" width="50">

                        </td>
                        <td>{{ $user->Name_User ?: 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $user->Email ?: 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $user->Address ?: 'ไม่มีข้อมูล' }}</td>
                        <td>{{ $user->Phone ?: 'ไม่มีข้อมูล' }}</td>
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
