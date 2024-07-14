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
        .modal-content {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .close {
            float: right;
            cursor: pointer;
        }
        #recommendationsText {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    @include('layout.nav') <!-- Assuming this includes your navigation -->
    @include('doctor.LayoutD.sidebar') <!-- Assuming this includes your sidebar -->
    
    <div class="container">
        <h2>ออกรายงาน</h2>
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
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $report->Name_Elderly }}</td>
                    <td class="text-center">{{ $report->Birthday }}</td> 
                    <td class="text-center">{{ $report->Weight }}</td>
                    <td class="text-center">{{ $report->Height }}</td>
                    <td class="text-center">{{ $report->Address }}</td>
                    <td class="text-center">{{ $report->Group_ADL }}</td>
                    <td class="text-center">
                        <button class="btn btn-primary" onclick="showCareAdvice('{{ $report->Care_Advice }}', '{{ $report->Name_Elderly }}', '{{ $report->Birthday }}', '{{ $report->Weight }}', '{{ $report->Address }}', '{{ $report->Group_ADL }}')">แนะนำการดูแล</button>
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
                    <textarea id="recommendationsText" rows="5" required></textarea>
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
        location.reload();
    }, 0.1); 
}
    </script>
    
</body>
</html>
