<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข่าวสาร</title>
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            color: #344767;
        }

        .news,
        .statistics,
        .contact-form {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .news h2,
        .statistics h2,
        .contact-form h2 {
            margin-bottom: 20px;
        }

        .news-item,
        .stat-item {
            margin-bottom: 15px;
        }

        .news-item h3,
        .stat-item h3 {
            margin-bottom: 5px;
        }

        .news-item p {
            margin-bottom: 13px;
        }

        .news-item a {
            color: #fb6340;
            text-decoration: none;
        }

        .news-item a:hover {
            text-decoration: underline;
        }

        .statistics .stats {
            display: flex;
            gap: 20px;
        }

        .statistics .stat-item {
            flex: 1;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-form form div {
            margin-bottom: 15px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 5px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .contact-form button {
            background-color: #fb6340;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #ea3005;
        }

        footer {
            background-color: #344767;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }

        footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        footer ul li {
            display: inline;
        }

        footer ul li a {
            color: #fff;
            text-decoration: none;
        }

        footer ul li a:hover {
            text-decoration: underline;
        }

        .slider {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 500px;
            margin-bottom: 50px;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slides img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }

        .modal img {
            width: 100%;
            height: auto;
        }

        .modal-dialog-centered {
            max-width: 90%;
            margin: 30px auto;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-card .icon {
            font-size: 2em;
            color: #fb6340;
        }

        .dashboard-card h3 {
            margin: 0;
        }

        .dashboard-card p {
            margin: 5px 0 0;
        }

        .news-item img {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .news-item img:hover {
            transform: scale(1.05);
        }

        .news-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .admin-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 20px;
        }

        .admin-buttons .btn {
            margin-right: 0;
        }

        .admin-buttons a {
            background-color: #fb6340;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .admin-buttons a:hover {
            background-color: #ea3005;
        }

        .image-grid {
            display: grid;
            gap: 10px;
        }

        .image-grid img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        @media (min-width: 600px) {
            .image-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 900px) {
            .image-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .image-item::after {
            content: "";
            display: block;
            padding-bottom: 100%;
            /* Maintain square aspect ratio */
        }

        .image-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-item:hover img {
            opacity: 0.5;
        }

        .image-grid {
            display: grid;
            gap: 10px;
        }

        .image-grid img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        @media (min-width: 600px) {
            .image-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 900px) {
            .image-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .image-item {
            position: relative;
            overflow: hidden;
        }

        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .more-overlay .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            font-size: 2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Lightbox Styles */
        .lightbox {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .lightbox-content {
            position: relative;
            margin: auto;
            max-width: 90%;
            max-height: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .lightbox-content img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            display: block;
        }

        .close-lightbox {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        /* Lightbox navigation buttons */
        .prev-lightbox,
        .next-lightbox {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px;
        }

        .prev-lightbox {
            left: 10px;
        }

        .next-lightbox {
            right: 10px;
        }

        .short-content {
            display: block;
        }

        .full-content {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    @include('layout.nav')

    <!-- Slider -->
    <section class="slider">
        <div class="slides">
            @foreach ($sliders as $slider)
                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image">
            @endforeach
        </div>
        <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
        <button class="next" onclick="plusSlides(1)">&#10095;</button>
    </section>
    <div class="admin-buttons">
        <button class="btn btn-primary" data-toggle="modal" data-target="#createSliderModal">เพิ่มรูปเลื่อนสไลด์</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#viewSliderModal">แก้ไขรูปเลื่อนสไลด์</button>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- จำนวนผู้เข้าชมเว็บไซต์ -->
            <div class="col-sm-3">
                <div class="dashboard-card">
                    <div>
                        <h3>จำนวนผู้เข้าชมเว็บไซต์</h3>
                        <p>{{ $visitorCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="ni ni-tv-2"></i>
                    </div>
                </div>
            </div>
            <!-- ข่าวสารประชาสัมพันธ์ -->
            <div class="col-sm-6">
                <section class="news">
                    <div class="admin-buttons">
                        <button class="btn btn-primary" data-toggle="modal"
                            data-target="#createNewsModal">เพิ่มข่าวสาร</button>
                    </div>
                    <h2>ข่าวสารประชาสัมพันธ์</h2>
                    @foreach ($news as $newsItem)
                        <div class="news-container">
                            <div class="news-item">
                                <h3>{{ $newsItem->title }}</h3>
                                <p class="short-content">
                                    {{ Str::limit($newsItem->content, 150) }}
                                    <a href="#" class="toggle-content"
                                        onclick="toggleContent(event, this)">ดูเพิ่มเติม</a>
                                </p>
                                <p class="full-content" style="display: none;">
                                    {{ $newsItem->content }}
                                    <a href="#" class="toggle-content"
                                        onclick="toggleContent(event, this)">ดูน้อยลง</a>
                                </p>
                                <div class="image-grid">
                                    @foreach ($newsItem->images as $index => $image)
                                        @if ($index < 1)
                                            <div class="image-item">
                                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                                    alt="{{ $newsItem->title }}"
                                                    onclick="openLightbox('{{ asset('storage/' . $image->image_path) }}', [
                                                        @foreach ($newsItem->images as $img) '{{ asset('storage/' . $img->image_path) }}', @endforeach
                                                    ], {{ $index }})">
                                            </div>
                                        @endif
                                    @endforeach

                                    @if (count($newsItem->images) === 2)
                                        <div class="image-item">
                                            <img src="{{ asset('storage/' . $newsItem->images[1]->image_path) }}"
                                                alt="{{ $newsItem->title }}"
                                                onclick="openLightbox('{{ asset('storage/' . $newsItem->images[1]->image_path) }}', [@foreach ($newsItem->images as $img) '{{ asset('storage/' . $img->image_path) }}', @endforeach], 3)">
                                        </div>
                                    @elseif (count($newsItem->images) > 2)
                                        <div class="image-item" style="position: relative;">
                                            <img src="{{ asset('storage/' . $newsItem->images[1]->image_path) }}"
                                                alt="{{ $newsItem->title }}"
                                                onclick="openLightbox('{{ asset('storage/' . $newsItem->images[1]->image_path) }}', [@foreach ($newsItem->images as $img) '{{ asset('storage/' . $img->image_path) }}', @endforeach], 3)">
                                            <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); color: white; display: flex; align-items: center; justify-content: center; font-size: 24px;"
                                                onclick="openLightbox('{{ asset('storage/' . $newsItem->images[1]->image_path) }}', [@foreach ($newsItem->images as $img) '{{ asset('storage/' . $img->image_path) }}', @endforeach], 3)">
                                                +{{ count($newsItem->images) - 2 }}
                                            </div>
                                        </div>
                                    @endif

                                </div>


                                <!-- Lightbox HTML -->
                                <div id="lightbox" class="lightbox">
                                    <span class="close-lightbox" onclick="closeLightbox()">&times;</span>
                                    <button class="prev-lightbox" onclick="changeImage(-1)">&#10094;</button>
                                    <div class="lightbox-content">
                                        <img id="lightbox-img" src="" alt="Lightbox Image">
                                    </div>
                                    <button class="next-lightbox" onclick="changeImage(1)">&#10095;</button>
                                </div>

                                <button class="btn btn-warning" data-id="{{ $newsItem->id }}"
                                    onclick="showEditModal('{{ $newsItem->id }}', '{{ $newsItem->title }}', '{{ $newsItem->content }}', [
                                        @foreach ($newsItem->images as $image)
                                            '{{ asset('storage/' . $image->image_path) }}', @endforeach
                                    ])">แก้ไข</button>

                                <!-- ปุ่มลบ -->
                                <form action="{{ route('admin.news.destroy', $newsItem->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข่าวสารนี้?');">ลบ</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </section>
            </div>
            <!-- จำนวนการประเมิน ADL และ CG -->
            <div class="col-sm-3">
                <!-- จำนวนการประเมิน ADL -->
                <div class="dashboard-card">
                    <div>
                        <h3>จำนวนการประเมิน ADL</h3>
                        <p>{{ $adlAssessmentCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="ni ni-check-bold"></i>
                    </div>
                </div>
                <!-- จำนวนการประเมิน CG -->
                <div class="dashboard-card">
                    <div>
                        <h3>จำนวนการประเมิน CG</h3>
                        <p>{{ $cgAssessmentCount }}</p>
                    </div>
                    <div class="icon">
                        <i class="ni ni-bullet-list-67"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">รูปภาพข่าวสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalContent"></p>
                    <img id="modalImage" src="" alt="News Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Create News -->
    <div class="modal fade" id="createNewsModal" tabindex="-1" role="dialog" aria-labelledby="createNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewsModalLabel">เพิ่มข่าวสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">หัวข้อ:</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="content">เนื้อหา:</label>
                            <textarea id="content" name="content" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" id="customFile" name="images[]" class="form-control-file" multiple onchange="previewImages(event)" style="display: none;">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('customFile').click()">เลือกไฟล์รูป</button>
                        </div>
                        <div class="form-group">
                            <div id="imagePreview" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImages(event) {
            let imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // ล้างภาพเก่าออกก่อน

            for (let i = 0; i < event.target.files.length; i++) {
                let file = event.target.files[i];
                let reader = new FileReader();

                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.className = 'img-thumbnail'; // ใช้ Bootstrap class เพื่อความสวยงาม
                    imagePreview.appendChild(img);
                };

                reader.readAsDataURL(file); // อ่านไฟล์เพื่อแสดงตัวอย่าง
            }
        }
    </script>


    <!-- Modal for Edit News -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">แก้ไขข่าวสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editNewsForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">หัวข้อ:</label>
                            <input type="text" id="edit-title" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="content">เนื้อหา:</label>
                            <textarea id="edit-content" name="content" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="currentNewsImages">รูปภาพปัจจุบัน:</label>
                            <div id="currentNewsImages" style="display: flex; flex-wrap: wrap; gap: 5px;">
                                <!-- รูปภาพจะแสดงที่นี่ -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit-images">อัปโหลดรูปภาพใหม่:</label>
                            <input type="file" id="edit-images" name="images[]" class="form-control-file" multiple style="display: none;">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('edit-images').click()">เลือกไฟล์รูป</button>
                        </div>
                        <div class="form-group">
                            <div id="editImagePreview" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('edit-images').addEventListener('change', function(event) {
            let editImagePreview = document.getElementById('editImagePreview');
            editImagePreview.innerHTML = ''; // ล้างภาพเก่าออกก่อน

            for (let i = 0; i < event.target.files.length; i++) {
                let file = event.target.files[i];
                let reader = new FileReader();

                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.className = 'img-thumbnail'; // ใช้ Bootstrap class เพื่อความสวยงาม
                    editImagePreview.appendChild(img);
                };

                reader.readAsDataURL(file); // อ่านไฟล์เพื่อแสดงตัวอย่าง
            }
        });
    </script>



        <!-- Modal for Create Slider -->
    <div class="modal fade" id="createSliderModal" tabindex="-1" role="dialog"
        aria-labelledby="createSliderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSliderModalLabel">เพิ่มรูปเลื่อนสไลด์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" id="sliderImageFile" name="image" class="form-control-file" style="display: none;" required>
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('sliderImageFile').click()">เลือกไฟล์รูป</button>
                        </div>
                        <div class="form-group">
                            <div id="sliderImagePreview" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sliderImageFile').addEventListener('change', function(event) {
            let imagePreview = document.getElementById('sliderImagePreview');
            imagePreview.innerHTML = ''; // ล้างภาพเก่าออกก่อน

            for (let i = 0; i < event.target.files.length; i++) {
                let file = event.target.files[i];
                let reader = new FileReader();

                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.className = 'img-thumbnail'; // ใช้ Bootstrap class เพื่อความสวยงาม
                    imagePreview.appendChild(img);
                };

                reader.readAsDataURL(file); // อ่านไฟล์เพื่อแสดงตัวอย่าง
            }
        });
    </script>


    <!-- Modal for View Slider -->
    <div class="modal fade" id="viewSliderModal" tabindex="-1" role="dialog"
        aria-labelledby="viewSliderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewSliderModalLabel">แก้ไขรูปเลื่อนสไลด์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="sliderContent">
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image"
                                        width="100">
                                </td>
                                <td>
                                    <button class="btn btn-warning" data-id="{{ $slider->id }}"
                                        data-toggle="modal" data-target="#editSliderModal"
                                        onclick="setSliderData('{{ $slider->id }}', '{{ $slider->image }}')">แก้ไข</button>
                                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">ลบ</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- Modal for Edit Slider -->
    <div class="modal fade" id="editSliderModal" tabindex="-1" role="dialog"
        aria-labelledby="editSliderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSliderModalLabel">แก้ไขรูปเลื่อนสไลด์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editSliderForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="currentImage">รูปภาพปัจจุบัน:</label>
                            <img id="currentImage" src="" alt="Slider Image" width="100">
                        </div>
                        <div class="form-group">
                            <input type="file" id="editSliderImageFile" name="image" class="form-control-file" style="display: none;">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('editSliderImageFile').click()">เลือกไฟล์รูป</button>
                        </div>
                        <div class="form-group">
                            <div id="editSliderImagePreview" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editSliderImageFile').addEventListener('change', function(event) {
            let imagePreview = document.getElementById('editSliderImagePreview');
            imagePreview.innerHTML = ''; // ล้างภาพเก่าออกก่อน

            for (let i = 0; i < event.target.files.length; i++) {
                let file = event.target.files[i];
                let reader = new FileReader();

                reader.onload = function(e) {
                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.className = 'img-thumbnail'; // ใช้ Bootstrap class เพื่อความสวยงาม
                    imagePreview.appendChild(img);
                };

                reader.readAsDataURL(file); // อ่านไฟล์เพื่อแสดงตัวอย่าง
            }
        });
    </script>



    <!-- Footer -->
    <footer>
        <p>&copy; 2024 สำนักงานสาธารณสุข อำเภอห้วยราช จังหวัดบุรีรัมย์</p>
    </footer>

    <script>
        let currentImageIndex = 0;
        let images = [];
        let zoomLevel = 1;
        let isDragging = false;
        let startX, startY;
        let translateX = 0,
            translateY = 0;

        function openLightbox(imageSrc, imageArray, index) {
            currentImageIndex = index;
            images = imageArray;
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = imageSrc;
            document.getElementById('lightbox').style.display = 'flex';
            resetZoomAndPosition(); // รีเซ็ตซูมและตำแหน่งทุกครั้งที่เปิด
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        function changeImage(direction) {
            currentImageIndex += direction;
            if (currentImageIndex >= images.length) {
                currentImageIndex = 0;
            } else if (currentImageIndex < 0) {
                currentImageIndex = images.length - 1;
            }
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = images[currentImageIndex];
            resetZoomAndPosition(); // รีเซ็ตซูมและตำแหน่งเมื่อเปลี่ยนภาพ
        }

        function resetZoomAndPosition() {
            zoomLevel = 1;
            translateX = 0;
            translateY = 0;
            applyTransform();
        }

        function applyTransform() {
            const img = document.getElementById('lightbox-img');
            img.style.transform = `translate(${translateX}px, ${translateY}px) scale(${zoomLevel})`;
        }

        document.getElementById('lightbox-img').addEventListener('click', function() {
            zoomLevel = zoomLevel === 1 ? 2 : 1;
            if (zoomLevel === 1) {
                translateX = 0;
                translateY = 0;
            }
            applyTransform();
        });

        document.getElementById('lightbox-img').addEventListener('wheel', function(event) {
            event.preventDefault();
            const delta = event.deltaY < 0 ? 0.1 : -0.1;
            zoomLevel = Math.min(Math.max(zoomLevel + delta, 1), 5);
            applyTransform();
        });

        document.getElementById('lightbox-img').addEventListener('mousedown', function(event) {
            if (zoomLevel > 1) {
                isDragging = true;
                startX = event.clientX - translateX;
                startY = event.clientY - translateY;
                this.classList.add('grabbing');
            }
        });

        document.addEventListener('mousemove', function(event) {
            if (isDragging) {
                const lightboxImg = document.getElementById('lightbox-img');
                translateX = event.clientX - startX;
                translateY = event.clientY - startY;

                const maxTranslateX = ((zoomLevel - 1) * lightboxImg.width) / 2;
                const maxTranslateY = ((zoomLevel - 1) * lightboxImg.height) / 2;

                translateX = Math.max(Math.min(translateX, maxTranslateX), -maxTranslateX);
                translateY = Math.max(Math.min(translateY, maxTranslateY), -maxTranslateY);

                applyTransform();
            }
        });

        document.addEventListener('mouseup', function() {
            if (isDragging) {
                isDragging = false;
                document.getElementById('lightbox-img').classList.remove('grabbing');
            }
        });

        document.addEventListener('mouseleave', function() {
            if (isDragging) {
                isDragging = false;
                document.getElementById('lightbox-img').classList.remove('grabbing');
            }
        });

        let slideIndex = 0;
        const slides = document.querySelector('.slides');

        function showSlides() {
            const totalSlides = slides.children.length;
            slideIndex++;
            if (slideIndex >= totalSlides) {
                slideIndex = 0;
            }
            slides.style.transform = `translateX(${-slideIndex * 100}%)`;
        }

        function plusSlides(n) {
            slideIndex += n;
            const totalSlides = slides.children.length;
            if (slideIndex < 0) {
                slideIndex = totalSlides - 1;
            } else if (slideIndex >= totalSlides) {
                slideIndex = 0;
            }
            slides.style.transform = `translateX(${-slideIndex * 100}%)`;
        }

        setInterval(showSlides, 3000);

        function showEditModal(id, title, content, images) {
            // ตั้งค่า URL ในฟอร์มสำหรับอัปเดตข้อมูลข่าวสาร
            document.getElementById('editNewsForm').action = '/news/' + id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-content').value = content;

            // ล้างรูปภาพปัจจุบันที่แสดงอยู่ก่อนหน้า
            let imageContainer = document.getElementById('currentNewsImages');
            imageContainer.innerHTML = '';

            // แสดงรูปภาพที่มีอยู่แล้วถ้ามี
            images.forEach(function(imagePath) {
                let img = document.createElement('img');
                img.src = imagePath; // ตั้งค่าลิงก์ของรูปภาพ
                img.alt = 'Current News Image';
                img.className = 'img-thumbnail'; // เพิ่มคลาส img-thumbnail เพื่อใช้ Bootstrap class
                img.style.width = '100px'; // ปรับขนาดความกว้างของรูปภาพ
                img.style.height = '100px'; // ให้ความสูงอัตโนมัติตามสัดส่วน
                imageContainer.appendChild(img);
            });

            // เปิด Modal
            $('#editNewsModal').modal('show');
        }

        function setSliderData(id, image) {
            const form = document.getElementById('editSliderForm');
            form.action = `/sliders/${id}`;
            document.getElementById('currentImage').src = `/storage/${image}`;
        }

        function showModal(image, title, content) {
            document.getElementById('modalImage').src = image;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalContent').textContent = content;
            $('#imageModal').modal('show');
        }

        function toggleContent(event, element) {
            event.preventDefault();

            const newsItem = element.closest('.news-item');
            const shortContent = newsItem.querySelector('.short-content');
            const fullContent = newsItem.querySelector('.full-content');

            // สลับการแสดงผลของเนื้อหา
            if (shortContent.style.display === 'none') {
                shortContent.style.display = 'block';
                fullContent.style.display = 'none';
            } else {
                shortContent.style.display = 'none';
                fullContent.style.display = 'block';
            }
        }

    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
