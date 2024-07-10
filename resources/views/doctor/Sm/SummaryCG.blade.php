<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .details {
            display: none;
        }
    </style>
</head>
<body>
    @include('layout.nav')
    @include('doctor.LayoutD.sidebar')
    <div class="container">
        <h2>ข้อมูล (CG)</h2>
        <form class="search-form">
            <input type="text" id="searchInput" placeholder="ค้นหาตามชื่อ..." onkeyup="searchTable()">
            <button type="button" class="btn" onclick="clearSearch()">ล้าง</button>
        </form>
        <table id="CG" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">วันที่</th>
                    <th class="text-center">ชื่อ</th>
                    <th class="text-center">Vital Signs</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Assuming $Elderlys is the array passed from your server-side script -->
                @foreach($Elderlys as $Elderly)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $Elderly->Date_CG }}</td>
                    <td class="text-center name">{{ $Elderly->Name_Elderly }}</td>
                    <td class="text-center">{{ $Elderly->Vital_signs }}</td>
                    <td><button class="btn" onclick="toggleDetails(this)">ข้อมูลเพิ่มเติม</button></td>
                </tr>
                <tr class="details">
                    <td colspan="5">
                        <div>
                            <table>
                                <tr>
                                    <td>แผลกดทับ:</td>
                                    <td>
                                        @if($Elderly->Bedsores == 'มี')
                                            มีแผลกดทับ
                                        @elseif($Elderly->Bedsores == 'ไม่มี')
                                            ไม่มีแผลกดทับ
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>ความรู้สึกเจ็บปวด:</td>
                                    <td>
                                        @if($Elderly->Pain == 'มี')
                                            มีความรู้สึกเจ็บ
                                        @elseif($Elderly->Pain == 'ไม่มี')
                                            ไม่มีความรู้สึกเจ็บ
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>อาการบวม:</td>
                                    <td>
                                        @if($Elderly->Swelling == 'มี')
                                            มีอาการบวม
                                        @elseif($Elderly->Swelling == 'ไม่มี')
                                            ไม่มีมีอาการบวม
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>ผื่นคัน:</td>
                                    <td>
                                        @if($Elderly->Itchy_rash == 'มี')
                                            มีผื่นคัน
                                        @elseif($Elderly->Bedsores == 'ไม่มี')
                                            ไม่มีผื่นคันบ
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>ข้อต่อแข็ง:</td>
                                    <td>
                                        @if($Elderly->Stiff_joints == 'มี')
                                        ข้อต่อแข็ง
                                        @elseif($Elderly->Stiff_joints == 'ไม่มี')
                                        ข้อต่อไม่แข็ง
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>การขาดสารอาหาร:</td>
                                    <td>
                                        @if($Elderly->Malnutrition == 'มี')
                                        ขาดสารอาหาร
                                        @elseif($Elderly->Malnutrition == 'ไม่มี')
                                        ไม่ขาดสารอาหาร
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>กินข้าวเองได้ไหม:</td>
                                    <td>
                                        @if($Elderly->Eating == 'ตักกินเองได้')
                                        ได้
                                        @elseif($Elderly->Eating == 'ตักกินเองไม่ได้')
                                        ไม่ได้
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>การกลืนอาหาร:</td>
                                    <td>
                                        @if($Elderly->Swallowing == 'กลืนได้ปกติ')
                                        กลืนได้ปกติ
                                        @elseif($Elderly->Swallowing == 'กลืนลำบาก')
                                        กลืนลำบาก
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>การกลั้นถ่ายอุจจาระ:</td>
                                    <td>
                                        @if($Elderly->Defecation == 'กลั้นได้')
                                        กลั้นได้
                                        @elseif($Elderly->Defecation == 'กลั้นไม่ได้')
                                        กลั้นไม่ได้
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>กินยา:</td>
                                    <td>
                                        @if($Elderly->Taking_medicine == 'กินสม่ำเสมอ')
                                        กินสม่ำเสมอ
                                        @elseif($Elderly->Taking_medicine == 'ขาดยา')
                                        ขาดยา
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>สภาพอารมณ์:</td>
                                    <td>
                                        @if($Elderly->Emotional_state == 'ปกติ')
                                        ปกติ
                                        @elseif($Elderly->Emotional_state == 'ผิดปกติ')
                                        ผิดปกติ
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>ปัญหาเศรษฐกิจ:</td>
                                    <td>
                                        @if($Elderly->Economic_problems == 'มี')
                                        มี
                                        @elseif($Elderly->Economic_problems == 'ไม่มี')
                                        ไม่มี
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>ปัญหาสังคม:</td>
                                    <td>
                                        @if($Elderly->Social_problems == 'มี')
                                        มี
                                        @elseif($Elderly->Social_problems == 'ไม่มี')
                                        ไม่มี
                                        @endif
                                    </td>
                               </tr>
                                <tr>
                                    <td>แพทย์นัดไหม:</td>
                                    <td>
                                        @if($Elderly->Doctor_FU == 'มี')
                                        มี
                                        @elseif($Elderly->Doctor_FU == 'ไม่มี')
                                        ไม่มี
                                        @endif
                                    </td>
                               </tr>
                               <tr>
                                <td>ปัญหาอื่นๆ:</td>
                                <td>
                                    @if(!empty($Elderly->Other_problems))
                                        {{ $Elderly->Other_problems }}
                                    @endif
                                </td>
                            </tr>
                               <tr>
                                <td>การช่วยเหลือ:</td>
                                <td>
                                    @if(!empty($Elderly->Assistance))
                                        {{ $Elderly->Assistance }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>ผู้รายงาน:</td>
                                <td>
                                    @if(!empty($Elderly->Reporter))
                                        {{ $Elderly->Reporter }}
                                    @else
                                
                                    @endif
                                </td>
                            </tr>
                            
                            </table>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <script>
        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("CG");
            const tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i += 2) {
                const nameCell = tr[i].getElementsByClassName("name")[0];
                if (nameCell) {
                    const txtValue = nameCell.textContent || nameCell.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        tr[i + 1].style.display = ""; // Show the details row
                    } else {
                        tr[i].style.display = "none";
                        tr[i + 1].style.display = "none"; // Hide the details row
                    }
                }
            }
        }

        function clearSearch() {
            document.getElementById("searchInput").value = "";
            searchTable();
        }

        function toggleDetails(button) {
            const detailsRow = button.closest('tr').nextElementSibling;
            if (detailsRow.style.display === "none" || detailsRow.style.display === "") {
                detailsRow.style.display = "table-row";
            } else {
                detailsRow.style.display = "none";
            }
        }
    </script>
</body>
</html>
