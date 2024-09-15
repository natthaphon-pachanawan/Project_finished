<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <title>จัดการคำแนะนำการดูแลที่ยืนยันแล้ว</title>
</head>
<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <!-- Confirmed Care Instructions Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4>คำแนะนำการดูแลที่ยืนยันแล้ว</h4>
                            <a href="javascript:void(0);" id="generate-pdf" class="btn btn-success ml-2">
                                <i class="fas fa-print"></i>
                            </a>
                        </div>
                        <div class="card-body px-3 pt-3 pb-2">
                            <div class="table-responsive p-0">
                                <table id="ciTableConfirmed" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">วันที่</th>
                                            <th class="text-center">ชื่อผู้สูงอายุ</th>
                                            <th class="text-center">ที่อยู่</th>
                                            <th class="text-center">เบอร์โทร</th>
                                            <th class="text-center">ชื่อแพทย์</th>
                                            <th class="text-center">คำแนะนำ</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($careInstructions as $ci)
                                            @if(!empty($ci->Confirm))
                                                <tr>
                                                    <td class="text-center">{{ $ci->Date_CI }}</td>
                                                    <td class="text-center">{{ $ci->Name_Elderly }}</td>
                                                    <td class="text-center">{{ $ci->elderly->Address }}</td>
                                                    <td class="text-center">{{ $ci->elderly->Phone_Elderly }}</td>
                                                    <td class="text-center">{{ $ci->Name_Doctor }}</td>
                                                    <td class="text-center">{{ $ci->Care_instructions }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('search-location', ['id' => $ci->elderly->ID_Elderly]) }}" target="_blank" class="btn btn-info btn-sm">ค้นหาที่อยู่</a>
                                                        <button class="generate-single-report btn btn-success btn-sm" data-id="{{ $ci->ID_CI }}">
                                                            ออกรายงาน
                                                        </button>
                                                        <form action="{{ route('ci.unconfirm', ['id' => $ci->ID_CI]) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-danger btn-sm">ยกเลิกยืนยัน</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>
<!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ciTableConfirmed').DataTable({
                "language": {
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
                    },
                    "search": "ค้นหา : ",
                    "lengthMenu": "แสดง _MENU_ รายการ",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "info": "กำลังแสดงรายการ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                    "infoEmpty": "ไม่พบข้อมูล",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                },
                "dom": '<"row"<"col-sm-12 col-md-12"l><"col-sm-12 col-md-12"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-2 d-flex justify-content-center"p>>'
            });
        });

            document.getElementById('generate-pdf').addEventListener('click', function () {
                // Fetch the content from the /report-ci-confirm URL
                fetch(`{{ route('report.ci.confirm') }}`)
                    .then(response => response.text()) // Fetch HTML as text
                    .then(data => {
                        // Convert the fetched HTML into a DOM object
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, 'text/html');
                        const element = doc.querySelector('.container'); // Get the content

                        // Add CSS to set the font back to the template's original font
                        const style = document.createElement('style');
                        style.innerHTML = `
                            * {
                                font-family: 'Open Sans', Arial, sans-serif !important;
                                color: black !important;
                                background-color: white !important;
                            }

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

                                img {
                                    height: 80px;
                                    margin-right: 10px;
                                }

                                .container {
                                    padding: 10mm;
                                    border-radius: 5px;
                                }

                                h5 {
                                    text-align: left;
                                    margin-bottom: 20px;
                                    font-size: 20px;
                                }

                                table {
                                    width: 106%;

                                }

                                th, td {
                                    font-size: 12px;
                                    border: 1px solid black;
                                    padding: 8px;
                                    text-align: left;
                                }

                                td.instructions-col {
                                    font-size: 10px;
                                }

                                th {
                                    text-align: center;
                                    background-color: #f2f2f2;
                                }

                                .page-break {
                                    page-break-before: always;
                                }

                                /* Adjust column widths */
                                th.date-col, td.date-col {
                                    width: 11%; /* Adjust as needed */
                                }

                                th.name-col, td.name-col {
                                    width: 15%; /* Adjust as needed */
                                }

                                th.phone-col, td.phone-col {
                                    width: 15%; /* Adjust as needed */
                                }

                                th.doctor-col, td.doctor-col {
                                   width: 15%; /* Adjust as needed */
                                }

                                th.staff-col, td.staff-col {
                                    width: 15%; /* Adjust as needed */
                                }

                                th.instructions-col, td.instructions-col {
                                    width: 35%; /* Adjust as needed */
                                }
                            </style>

                        `;
                        element.appendChild(style);

                        // Configure options for generating the PDF
                        var opt = {
                            margin: 0.5,
                            filename: 'รายงานคำแนะนำการดูแล_CI.pdf',
                            image: { type: 'jpeg', quality: 0.98 },
                            html2canvas: { scale: 2 },
                            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                        };

                        // สร้าง PDF และเปิดในหน้าต่างใหม่
                        html2pdf().set(opt).from(element).output('blob').then(function (pdfBlob) {
                            var pdfUrl = URL.createObjectURL(pdfBlob);
                            var pdfWindow = window.open();
                            pdfWindow.location.href = pdfUrl;
                        });
                    })
                    .catch(error => console.error('Error fetching report data:', error));
            });

            document.querySelectorAll('.generate-single-report').forEach(button => {
                button.addEventListener('click', function() {
                    const ciId = this.dataset.id;
                    fetch(`{{ route('report.ci.single', ['id' => '${ciId}']) }}`)
                        .then(response => response.text())
                        .then(data => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(data, 'text/html');
                            const element = doc.getElementById('report-content'); // Your report HTML content

                            // Add styles for the PDF
                            const style = document.createElement('style');
                            style.innerHTML = `
                                * {
                                    font-family: 'Open Sans', Arial, sans-serif !important;
                                    color: black !important;
                                    background-color: white !important;
                                }
                            `;
                            element.appendChild(style);

                            // Configure options for generating the PDF
                            var opt = {
                                margin: 0.5,
                                image: { type: 'jpeg', quality: 0.98 },
                                html2canvas: { scale: 2 },
                                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                            };

                            // Generate and open the PDF
                            html2pdf().set(opt).from(element).outputPdf('blob').then(function (pdfBlob) {
                                var pdfUrl = URL.createObjectURL(pdfBlob);
                                var pdfWindow = window.open();
                                pdfWindow.location.href = pdfUrl;
                            });
                        })
                        .catch(error => console.error('Error generating PDF:', error));
                });
            });

    </script>
</html>
