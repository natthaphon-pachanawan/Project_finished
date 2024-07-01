<!DOCTYPE html>
<html lang="en">
<head>
    <title>ADL Assessment Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .content {
            max-width: 1000px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    @include('layout.nav')

    <div class="content">
        <h1>ADL Assessment Results</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Elderly Name</th>
                    <th>User Name</th>
                    <th>Total Score</th>
                    <th>Group</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assessments as $assessment)
                    <tr>
                        <td>{{ $assessment->id }}</td>
                        <td>{{ $assessment->Name_Elderly }}</td>
                        <td>{{ $assessment->Name_User }}</td>
                        <td>{{ $assessment->Score_ADL }}</td>
                        <td>{{ $assessment->Group_ADL }}</td>
                        <td>{{ $assessment->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('/staff-dashboard') }}" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>
