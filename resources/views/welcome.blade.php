<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบประเมินความสามารถในการดำเนินกิจวัตรประจำวันของผู้สูงอายุ</title>
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
            margin-bottom: 10px;
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
            max-width: 80%;
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

        #adlChart {
            max-width: 100%;
            margin: 20px 0;
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
                    <h2>ข่าวสารประชาสัมพันธ์</h2>
                </section>
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
                                        <img id="lightbox-img" src="" alt="Lightbox Image" draggable="false">
                                    </div>
                                    <button class="next-lightbox" onclick="changeImage(1)">&#10095;</button>
                                </div>

                            </div>
                        </div>
                    @endforeach

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
                <div class="dashboard-card">
                    <canvas id="adlChart"></canvas>
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

    {{--  <!-- ฟอร์มติดต่อ -->
    <section class="contact-form">
        <h2>ติดต่อเรา</h2>
        <form action="path/to/your/form/handler" method="POST">
            <div>
                <label for="name">ชื่อ:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">อีเมล:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="message">ข้อความ:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">ส่งข้อความ</button>
        </form>
    </section>  --}}

    <!-- Modal for Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">รูปภาพข่าวสาร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modalContent"></p>
                    <img id="modalImage" src="" alt="News Image">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 สำนักงานสาธารณสุข อำเภอห้วยราช จังหวัดบุรีรัมย์</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
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

        function showModal(imageUrl, title, content) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('imageModalLabel').textContent = title;
            document.getElementById('modalContent').textContent = content;
            $('#imageModal').modal('show');
        }

        function toggleSidebar() {
            var sidebar = document.querySelector('.sidenav');
            sidebar.classList.toggle('collapsed');
        }

        const adlChartContext = document.getElementById('adlChart').getContext('2d');
        const adlData = {
            labels: ['กลุ่มติดสังคม', 'กลุ่มติดบ้าน', 'กลุ่มติดเตียง'],
            datasets: [{
                label: 'จำนวนการประเมิน ADL',
                data: [
                    {{ $adlGroupCounts['กลุ่มติดสังคม'] }},
                    {{ $adlGroupCounts['กลุ่มติดบ้าน'] }},
                    {{ $adlGroupCounts['กลุ่มติดเตียง'] }}
                ],
                backgroundColor: ['#3498db', '#2ecc71', '#e74c3c'],
                borderWidth: 1
            }]
        };
        const adlChart = new Chart(adlChartContext, {
            type: 'bar',
            data: adlData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

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

            // ซูมเข้าเมื่อคลิกที่รูปภาพ
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

    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
