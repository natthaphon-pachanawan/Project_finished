<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CG Information</title>
    <!-- Argon Dashboard CSS -->
    <link href="{{ url('assets/css/argon-dashboard.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    {{--  pdf  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
        .container {
            margin-top: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    @include('layout.nav')

    <main class="main-content position-relative h-100 border-radius-lg">
        <div class="container-fluid py-4">

            <!-- CG Information Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4>รายงานผลการปฏิบัติงานผู้ดูแลผู้สูงอายุ (CG)</h4>
                            <div class="d-flex gap-2">
                            <a href="{{ route('cg.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> เพิ่ม CG
                            </a>
                            <button id="generate-pdf" class="btn btn-success">
                                <i class="fas fa-print"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="cgTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">วันที่</th>
                                            <th class="text-center">ชื่อผู้สูงอายุ</th>
                                            <th class="text-center">ชื่อผู้ดูแลผู้สูงอายุ</th>
                                            <th class="text-center">ประเภทกลุ่มผู้สูงอายุ</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($careGivers as $cg)
                                            <tr>
                                                <td class="text-center">{{ $cg->Date_CG }}</td>
                                                <td class="text-center">{{ $cg->Name_Elderly }}</td>
                                                <td class="text-center">{{ $cg->Name_CG }}</td>
                                                <td class="text-center">{{ $cg->Group_ADL }}</td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="generatePdf('{{ $cg->ID_CG }}')">ออกรายงาน</a>
                                                    <a href="{{ route('cg.edit', ['id' => $cg->ID_CG]) }}"
                                                        class="btn btn-warning btn-sm">แก้ไข</a>
                                                    <form id="delete-cg-form-{{ $cg->ID_CG }}"
                                                        action="{{ route('cg.destroy', ['id' => $cg->ID_CG]) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete('{{ $cg->ID_CG }}')">ลบ</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Argon Dashboard JS -->
    <script src="{{ url('assets/js/argon-dashboard.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-notify.js') }}"></script>
    <script src="{{ url('assets/js/chartjs.min.js') }}"></script>
    <script src="{{ url('assets/js/Chart.extension.js') }}"></script>
    <script src="{{ url('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/smooth-scrollbar.min.js') }}"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cgTable').DataTable({
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


        function confirmDelete(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: "คุณจะไม่สามารถย้อนกลับได้หลังจากลบ!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-cg-form-' + id).submit();
                }
            });
        }


        document.getElementById('generate-pdf').addEventListener('click', function() {
            // Fetch the content from the /report-all-cg URL
            fetch("{{ route('report.all.cg') }}")
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
                                        padding: 20px;
                                        font-family: Arial, sans-serif;
                                        font-size: 15px;
                                    }

                                    .container {
                                        padding: 10mm;
                                        border-radius: 5px;
                                    }

                                    h5 {
                                        text-align: center;
                                        margin-bottom: 20px;
                                        font-size: 24px;
                                    }

                                    .info-section {
                                        margin-bottom: 20px;
                                    }

                                    table {
                                        width: 100%;
                                        margin-bottom: 20px;
                                    }

                                    th, td {
                                        border: 1px solid black;
                                        padding: 8px;
                                        text-align: left;
                                        front-size: 13px;
                                    }

                                </style>

                            `;
                    element.appendChild(style);

                    // Configure options for generating the PDF
                    var opt = {
                        margin: 0.5,
                        filename: 'รายงานข้อมูล_CG.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2
                        },
                        jsPDF: {
                            unit: 'in',
                            format: 'letter',
                            orientation: 'portrait'
                        }
                    };

                    // สร้าง PDF และเปิดในหน้าต่างใหม่
                    html2pdf().set(opt).from(element).output('blob').then(function(pdfBlob) {
                        var pdfUrl = URL.createObjectURL(pdfBlob);
                        var pdfWindow = window.open();
                        pdfWindow.location.href = pdfUrl;
                    });
                })
                .catch(error => console.error('Error fetching report data:', error));
        });

            function generatePdf(id) {
                // Fetch the content from the specific report-cg/{id} URL
                fetch(`{{ route('report.cg', ':id') }}`.replace(':id', id))
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

                            body {
                                width: 210mm;
                                height: 297mm;
                                margin: 0;
                                padding: 20mm;
                                font-family: Arial, sans-serif;
                                font-size: 12px;
                            }

                            .container {
                                padding: 10mm;
                                border-radius: 5px;
                            }

                            h5 {
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

                            th, td {
                                border: 1px solid black;
                                padding: 8px;
                                text-align: left;
                            }

                            th {
                                background-color: #f2f2f2;
                            }

                            .page-break {
                                page-break-before: always; /* บังคับขึ้นหน้าใหม่ */
                            }
                        `;
                        element.appendChild(style);

                        // Configure options for generating the PDF
                        var opt = {
                            margin: 0.5,
                            filename: 'รายงาน_CG_บุคคล.pdf',
                            image: { type: 'jpeg', quality: 0.98 },
                            html2canvas: { scale: 2 },
                            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                        };

                        // Generate the PDF and open it in a new window
                        html2pdf().set(opt).from(element).output('blob').then(function (pdfBlob) {
                            var pdfUrl = URL.createObjectURL(pdfBlob);
                            var pdfWindow = window.open();
                            pdfWindow.location.href = pdfUrl;
                        });
                    })
                    .catch(error => console.error('Error fetching report data:', error));
            }


    </script>
</body>

</html>
