<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ผลการทำแบบสอบถาม (ADL)</title>
    <style>
       <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #090909;
            margin: 20px;
            color: #fff;
        }

        .container {
            padding: 20px;
            border: 1px solid #131212;
            border-radius: 5px;
            background-color: #fff;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #0c0c0c;
            text-align: center;
        }

        thead {
            background-color: #e65907;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        .details {
            display: none;
            background-color: #737070;
            color: #fff;
        }

        .search-form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @include('layout.nav')
    @include('doctor.LayoutD.sidebar')
    <div class="container">
        <h2>ข้อมูล (ADL)</h2>
        <form class="search-form" onsubmit="event.preventDefault(); searchTable()">
            <input class="form-control me-2" type="search" id="searchInput" placeholder="ค้นหา" aria-label="ค้นหา">
            <button class="btn btn-outline-success" type="submit">ค้นหา</button>
            <button class="btn btn-outline-secondary" onclick="clearSearch()">ล้าง</button>
        </form>
        <table id="adlTable" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">ชื่อ</th>
                    <th class="text-center">คะแนน</th>
                    <th class="text-center">กลุ่ม</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <!-- Assuming $adls is the array passed from your server-side script -->
                @foreach($adls as $adl)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $adl->Name_Elderly }}</td>
                    <td class="text-center">{{ $adl->Score_ADL }}</td>
                    <td class="text-center">{{ $adl->Group_ADL }}</td>
                    <td><button onclick="toggleDetails(this)">ข้อมูลเพิ่มเติม</button></td>
                </tr>
                <tr class="details">
                    <td colspan="5">
                        <div>
                            <table  >
                                <tr class="text-center">
                                    <td >การรับประทานอาหาร:</td>
                                    <td>
                                        @if($adl->Feeding == 2)
                                            ไม่สามารถตักอาหารเข้าปากได้ต้องมีคนป้อนให้
                                        @elseif($adl->Feeding == 1)
                                            ตักอาหารเองได้แต่ต้องมีคนช่วย เช่น ช่วยใช้ช้อนตักเตรียมไว้ให้หรือตัดเป็นเล็ก ๆ ไว้ล่วงหน้า
                                        @elseif($adl->Feeding == 0)
                                            ตักอาหารและช่วยตัวเองได้เป็นปกติ
                                        @endif
                                        <td>{{ $adl->Feeding }} คะแนน</td>
                                    </td>
                                </tr>                              
                                <tr>
                                    <td>การดูแลร่างกาย:</td>
                                    <td>
                                        @if($adl->Grooming ==1 )
                                        ต้องการความช่วยเหลือ
                                        @elseif($adl->Grooming ==0)
                                        ทำเองได้ (รวมทั้งที่ทำได้เองถ้าเตรียมอุปกรณ์ไว้ให้)
                                        @endif
                                        <td>{{ $adl->Grooming }} คะแนน</td>
                                    </td>    
                                </tr>
                                <tr>
                                    <td>การย้ายตัว:</td>
                                    <td>
                                    @if($adl->Transfer==3)
                                    ไม่สามารถนั่งได้ (นั่งแล้วจะล้มเสมอ) หรือต้องใช้คนสองคนช่วยกันยกขึ้น
                                    @elseif($adl->Transfer==2)
                                    ต้องการความช่วยเหลืออย่างมากจึงจะนั่งได้ เช่น ต้องใช้คนที่แข็งแรงหรือมีทักษะ 1 คน <br>หรือใช้คนทั่วไป 2 คนพยุงหรือดันขึ้นมาจึงจะนั่งอยู่ได้
                                    @elseif($adl->Transfer==1)
                                    ต้องการความช่วยเหลือบ้าง เช่น บอกให้ทำตาม หรือช่วยพยุงเล็กน้อย หรือต้องมีคนดูแลเพื่อความปลอดภัย
                                    @elseif($adl->Transfer==0)
                                    ทำได้เอง
                                    @endif
                                    <td>{{ $adl->Transfer }} คะแนน</td>
                                </td>
                                </tr>
                                <tr>
                                    <td>การใช้ห้องน้ำ :</td>
                                    <td>
                                        @if($adl->Toilet_use==2)
                                        ช่วยตัวเองไม่ได้
                                    @elseif($adl->Toilet_use==1)
                                    ทำเองได้บ้าง (อย่างน้อยทำความสะอาดตัวเองได้หลังจากเสร็จธุระ) แต่ต้องการความช่วยเหลือในบางสิ่ง
                                    @elseif($adl->Toilet_use==0)
                                    ทำเองได้ดี (ขึ้นนั่งและลงจากโถส้วมเองได้ ทำความสะอาดได้เรียบร้อยหลังจากเสร็จธุระ ถอดใส่เสื้อผ้าได้เรียบร้อย)
                                    @endif
                                    <td>{{ $adl->Toilet_use }} คะแนน</td>
                                </td>
                                </tr>
                                <tr>
                                    <td>การเคลื่อนที่ภายในห้องหรือบ้าน:</td>
                                    <td>
                                        @if($adl->Mobility==3)
                                        เคลื่อนที่ไปไหนไม่ได้
                                    @elseif($adl->Mobility==2)
                                    ต้องใช้รถเข็นช่วยตัวเองให้เคลื่อนที่ได้เอง (ไม่ต้องมีคนเข็นให้) และจะต้องเข้าออกมุมห้องหรือประตูได้
                                    @elseif($adl->Mobility==1)
                                    เดินหรือเคลื่อนที่โดยมีคนช่วย เช่น พยุง หรือบอกให้ทำตาม หรือต้องให้ความสนใจดูแลเพื่อความปลอดภัย
                                    @elseif($adl->Mobility==0)
                                    เดินหรือเคลื่อนที่ได้เอง
                                    @endif
                                    </td>
                                    <td>{{ $adl->Mobility }} คะแนน</td>
                                </tr>
                                <tr>
                                    <td>การสวมใส่เสื้อผ้า:</td>
                                    <td>
                                        @if($adl->Dressing==2)
                                        ต้องมีคนสวมให้ ช่วยตัวเองแทบไม่ได้หรือได้น้อย
                                    @elseif($adl->Dressing==1)
                                    ช่วยตัวเองได้ประมาณร้อยละ 50 ที่เหลือต้องมีคนช่วย
                                    @elseif($adl->Dressing==0)
                                    ช่วยตัวเองได้ดี (รวมทั้งการติดกระดุม รูดซิบ หรือใช้เสื้อผ้าที่ดัดแปลงให้เหมาะสมก็ได้)
                                    @endif
                                    </td>
                                    <td>{{ $adl->Dressing }} คะแนน</td>
                                </tr>
                                <tr>
                                    <td>การขึ้นลงบันได:</td>
                                    <td>
                                        @if($adl->Stairs==2)
                                        ไม่สามารถทำได้
                                    @elseif($adl->Stairs==1)
                                    ต้องการคนช่วย
                                    @elseif($adl->Stairs==0)
                                    ขึ้นลงได้เอง (ถ้าต้องใช้เครื่องช่วยเดิน เช่น walker จะต้องเอาขึ้นลงได้ด้วย)
                                    @endif
                                    </td>
                                    <td>{{ $adl->Stairs }} คะแนน</td>
                                </tr>
                                <tr>
                                    <td>การอาบน้ำ:</td>
                                    <td>
                                        @if($adl->Bathing==1)
                                        ต้องมีคนช่วยหรือทำให้
                                        @elseif($adl->Bathing==0)
                                        อาบน้ำเองได้
                                        @endif
                                    </td>
                                    <td>{{ $adl->Bathing }} คะแนน</td>
                                </tr>
                                <tr>
                                    <td>การกลั้นการถ่ายอุจจาระ:</td>
                                    <td>
                                        @if($adl->Bowels==2)
                                        กลั้นไม่ได้ หรือต้องการการสวนอุจจาระอยู่เสมอ
                                    @elseif($adl->Bowels==1)
                                    กลั้นไม่ได้บางครั้ง (เป็นน้อยกว่า 1 ครั้งต่อสัปดาห์)
                                    @elseif($adl->Bowels==0)
                                    กลั้นได้เป็นปกติ
                                    @endif
                                    </td>
                                    <td>{{ $adl->Bowels }}คะแนน</td>
                                </tr>
                                <tr>
                                    <td>การกลั้นปัสสาวะ:</td>
                                    <td>
                                        @if($adl->Bladder==2)
                                        กลั้นไม่ได้ หรือใส่สายสวนปัสสาวะแต่ไม่สามารถดูแลเองได้
                                    @elseif($adl->Bladder==1)
                                    กลั้นไม่ได้บางครั้ง (เป็นน้อยกว่าวันละ 1 ครั้ง)
                                    @elseif($adl->Bladder==0)
                                    กลั้นได้เป็นปกติ
                                    @endif
                                    </td>
                                    <td>{{ $adl->Bladder }}คะแนน</td>
                                </tr>
                                <tr>
                                    <td></td>
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
        // Function for toggling details
        function toggleDetails(button) {
            var detailsRow = button.closest('tr').nextElementSibling;
            if (detailsRow && detailsRow.tagName.toLowerCase() === 'tr') {
                detailsRow.classList.toggle('details');
            }
        }
    
        // Function for searching the table
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            table = document.getElementById('adlTable');
            tr = table.getElementsByTagName('tr');
    
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName('td')[1]; // Index 1 corresponds to the 'Name' column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = ''; // Show row if matches search
                    } else {
                        tr[i].style.display = 'none'; // Hide row if does not match search
                        var detailsRow = tr[i].nextElementSibling;
                        if (detailsRow && detailsRow.tagName.toLowerCase() === 'tr') {
                            detailsRow.style.display = 'none'; // Hide details row if exists
                        }
                    }
                }
            }
        }
    </script>
    
</body>
</html>