<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <!-- Include Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* General styling */
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
            color: #343a40;
        }

        .container {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #dee2e6;
            text-align: center;
        }

        thead {
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        .details {
            display: none;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .search-form {
            margin-bottom: 20px;
        }

        .btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
        }

        .modal-footer .btn-primary {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <!-- Navbar and Sidebar include here -->
    @include('layout.nav') 
    @include('doctor.LayoutD.sidebar')

    <div class="container">
        <h2>ออกรายงาน</h2>
        <form class="search-form">
            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="ค้นหาตามชื่อ...">
            <button type="button" class="btn" onclick="clearSearch()">ล้าง</button>
        </form>
        <table id="Report" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">ชื่อ</th>
                    <th class="text-center">วันเกิด</th>
                    <th class="text-center">น้ำหนัก</th>
                    <th class="text-center">ส่วนสูง</th>
                    <th class="text-center">ที่อยู่</th>
                    <th class="text-center">ข้อมูล ADL</th>
                    <th class="text-center">แนะนำการดูแล</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr id="row{{ $loop->index + 1 }}">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center name">{{ $report->Name_Elderly }}</td>
                    <td class="text-center">{{ $report->Birthday }}</td> 
                    <td class="text-center">{{ $report->Weight }}</td>
                    <td class="text-center">{{ $report->Height }}</td>
                    <td class="text-center">{{ $report->Address }}</td>
                    <td class="text-center">{{ $report->Group_ADL }}</td>
                    <td class="text-center">
                        <button class="btn" onclick="showCareAdvice('{{ $report->Care_Advice }}', '{{ $report->Name_Elderly }}', '{{ $report->Birthday }}', '{{ $report->Weight }}', '{{ $report->Address }}', '{{ $report->Group_ADL }}')">แนะนำการดูแล</button>
                    </td>
                </tr>
                <tr class="details">
                    <td colspan="8">
                        แนะนำการดูแล: {{ $report->Care_Advice }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="careAdviceModal" tabindex="-1" role="dialog" aria-labelledby="careAdviceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="careAdviceModalLabel">แนะนำการดูแล</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>สำหรับ <span id="elderlyName"></span></h4>
                    <p><strong>วันเกิด:</strong> <span id="elderlyBirthday"></span></p>
                    <p><strong>น้ำหนัก:</strong> <span id="elderlyWeight"></span></p>
                    <p><strong>ที่อยู่:</strong> <span id="elderlyAddress"></span></p>
                    <p><strong>ข้อมูล ADL:</strong> <span id="elderlyADL"></span></p>
                    <textarea id="recommendationsText" class="form-control" rows="5" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-primary" onclick="printRecommendations()">พิมพ์</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showCareAdvice(advice, elderlyName, birthday, weight, address, adl) {
            $('#recommendationsText').val(advice);
            $('#elderlyName').text(elderlyName);
            $('#elderlyBirthday').text(birthday);
            $('#elderlyWeight').text(weight);
            $('#elderlyAddress').text(address);
            $('#elderlyADL').text(adl);
            $('#careAdviceModal').modal('show');
        }
    
        function printRecommendations() {
            var textToPrint = $('#recommendationsText').val();
            var elderlyName = $('#elderlyName').text();
            var newWindow = window.open();
            newWindow.document.write('<html><head><title>แนะนำการดูแล</title></head><body><h2>สำหรับ ' + elderlyName + '</h2><p><strong>วันเกิด:</strong> ' + $('#elderlyBirthday').text() + '</p><p><strong>น้ำหนัก:</strong> ' + $('#elderlyWeight').text() + '</p><p><strong>ที่อยู่:</strong> ' + $('#elderlyAddress').text() + '</p><p><strong>ข้อมูล ADL:</strong> ' + $('#elderlyADL').text() + '</p><pre>' + textToPrint + '</pre></body></html>');
            newWindow.document.close();
            newWindow.print();
            setTimeout(function() {
                newWindow.close(); 
                location.reload();
            }, 1000); 
        }

        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("Report");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Index 1 corresponds to the column with names
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function clearSearch() {
            document.getElementById("searchInput").value = "";
            // Reset table to show all rows
            var table, tr;
            table = document.getElementById("Report");
            tr = table.getElementsByTagName("tr");
            for (var i = 0; i < tr.length; i++) {
                tr[i].style.display = "";
            }
        }
    </script>
</body>
</html>
