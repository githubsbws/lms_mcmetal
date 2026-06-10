@extends('layout/mainlayout')
@section('title', 'Brother e-learning')
@section('content')
@php
use App\Models\Downloadcategoty;
use App\Models\DownloadFile;

@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<style>
    .page-cover {
        position: relative;
        width: 100%;
        overflow: hidden;
        margin-top: 80px;
    }

    .image-slider {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        position: relative;
    }

    .slide {
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
    }

    .slide.active {
        opacity: 1;
        position: relative;
    }

    .slide img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .prev,
    .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }

    .owl-index {
        .owl-dots {
            display: none !important;
        }

        .owl-nav {
            display: none !important;
        }
    }

    .container-menu {
        margin-top: 20px;
    }

    /* ===== BREADCRUMB ===== */
    .how-to-use-breadcrumb {
        padding: 10px 20px;
    }

    .how-to-use-breadcrumb .breadcrumb {
        background-color: transparent;
        margin-bottom: 0;
    }

    .how-to-use-breadcrumb .breadcrumb>li {
        font-size: 24px;
        color: #464646;
    }

    .how-to-use-breadcrumb .breadcrumb>li>a {
        color: #464646;
        text-decoration: none;
    }

    .how-to-use-breadcrumb .breadcrumb>.active {
        color: #464646;
    }

    /* ===== PAGE TITLE ===== */
    .how-to-use-title {
        font-size: 32px;
        color: #000000;
        text-align: center;
        margin-bottom: 32px;
    }

    /* ===== CARD GRID ===== */

    /* ===== CARD ===== */
    .how-to-use-card {
        border: 1px solid #000;
        border-radius: 16px;
        overflow: hidden;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
        margin-bottom: 30px;
    }

    .how-to-use-card:hover {
        text-decoration: none;
        color: inherit;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .how-to-use-card:focus {
        text-decoration: none;
        color: inherit;
        outline: none;
    }

    .how-to-use-card-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }

    .how-to-use-card-label {
        padding: 12px 16px;
        font-size: 18px;
        color: #333;
        border-top: 1px solid #000;
    }

    /* ===== MODAL ===== */
    .how-to-use-modal .modal-title {
        font-size: 20px;
        color: #000;
    }

    .how-to-use-modal .modal-body ol {
        padding-left: 20px;
    }

    .how-to-use-modal .modal-body ol li {
        font-size: 14px;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.6;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 767px) {
        .how-to-use-breadcrumb {
            padding: 8px 15px;
        }

        .how-to-use-breadcrumb .breadcrumb>li {
            font-size: 18px;
        }

        .how-to-use-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .how-to-use-card-img {
            height: 150px;
        }
    }
</style>

<body>

    <div class="main-content">
        <div class="container-fluid">

            <!-- ===== BREADCRUMB ===== -->
            <div class="how-to-use-breadcrumb">
                <ol class="breadcrumb">
                    <li class="active">วิธีการใช้งาน</li>
                </ol>
            </div>

            <!-- ===== CONTENT ===== -->
            <div class="container">

                <!-- หัวข้อหน้า -->
                <h1 class="how-to-use-title">วิธีการใช้งาน</h1>

                <!-- Card grid: 5 cards -->
                <div class="row">
                    <!-- Card 1: วิธีการสมัครสมาชิก -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="#" class="how-to-use-card" data-toggle="modal" data-target="#modal-card-1">
                            <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400&h=180&fit=crop" alt="วิธีการสมัครสมาชิก" class="how-to-use-card-img">
                            <div class="how-to-use-card-label">วิธีการสมัครสมาชิก</div>
                        </a>
                    </div>

                    <!-- Card 2: ลืมรหัสผ่าน -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="#" class="how-to-use-card" data-toggle="modal" data-target="#modal-card-2">
                            <img src="https://images.unsplash.com/photo-1633265486064-086b219458ec?w=400&h=180&fit=crop" alt="ลืมรหัสผ่าน" class="how-to-use-card-img">
                            <div class="how-to-use-card-label">ลืมรหัสผ่าน</div>
                        </a>
                    </div>

                    <!-- Card 3: การเข้าสู่ห้องเรียนออนไลน์ -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="#" class="how-to-use-card" data-toggle="modal" data-target="#modal-card-3">
                            <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400&h=180&fit=crop" alt="การเข้าสู่ห้องเรียนออนไลน์" class="how-to-use-card-img">
                            <div class="how-to-use-card-label">การเข้าสู่ห้องเรียนออนไลน์</div>
                        </a>
                    </div>

                    <!-- Card 4: การสอบและผลการสอบ -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="#" class="how-to-use-card" data-toggle="modal" data-target="#modal-card-4">
                            <img src="https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?w=400&h=180&fit=crop" alt="การสอบและผลการสอบ" class="how-to-use-card-img">
                            <div class="how-to-use-card-label">การสอบและผลการสอบ</div>
                        </a>
                    </div>
                    <!-- Card 5: การพิมพ์ใบประกาศ -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="#" class="how-to-use-card" data-toggle="modal" data-target="#modal-card-5">
                            <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400&h=180&fit=crop" alt="การพิมพ์ใบประกาศ" class="how-to-use-card-img">
                            <div class="how-to-use-card-label">การพิมพ์ใบประกาศ</div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ===== MODAL 1: วิธีการสมัครสมาชิก ===== -->
    <div class="modal fade how-to-use-modal" id="modal-card-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">วิธีการสมัครสมาชิก</h4>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL 2: ลืมรหัสผ่าน ===== -->
    <div class="modal fade how-to-use-modal" id="modal-card-2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ลืมรหัสผ่าน</h4>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL 3: การเข้าสู่ห้องเรียนออนไลน์ ===== -->
    <div class="modal fade how-to-use-modal" id="modal-card-3" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">การเข้าสู่ห้องเรียนออนไลน์</h4>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL 4: การสอบและผลการสอบ ===== -->
    <div class="modal fade how-to-use-modal" id="modal-card-4" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">การสอบและผลการสอบ</h4>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL 5: การพิมพ์ใบประกาศ ===== -->
    <div class="modal fade how-to-use-modal" id="modal-card-5" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">การพิมพ์ใบประกาศ</h4>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                        <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500.</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <!--  <div class="owl-carousel owl-theme owl-index">
        <div class="item">
            <h4>1</h4>
        </div>
        <div class="item">
            <h4>2</h4>
        </div>
        <div class="item">
            <h4>3</h4>
        </div>
        <div class="item">
            <h4>4</h4>
        </div>
        <div class="item">
            <h4>5</h4>
        </div>
        <div class="item">
            <h4>6</h4>
        </div>
        <div class="item">
            <h4>7</h4>
        </div>
        <div class="item">
            <h4>8</h4>
        </div>
        <div class="item">
            <h4>9</h4>
        </div>
        <div class="item">
            <h4>10</h4>
        </div>
        <div class="item">
            <h4>11</h4>
        </div>
        <div class="item">
            <h4>12</h4>
        </div>
    </div> -->

    <!--  <div class="container-fluid">
        <div class="row menu-index">
            <div class="text" style="top: 0 !important;">
                <h2 class="menu-title">เมนู<br><span>ของเรา</span></h2>
            </div>

            <div class="col-6">

                <div class="menu-card pink">
                    <a href="course-main.php">
                        <img src="assets/images/online-test.png">
                        <p>หลักสูตรของฉัน</p>
                    </a>
                </div>
                <div class="menu-card orange">
                    <a href="guild.php">
                        <img src="assets/images/user-guide.png">
                        <p>วิธีการใช้งาน</p>
                    </a>
                </div>

                <div class="menu-card green" onclick="window.location.href='Status.php'">
                    <a href="course-main-2.php">
                        <img src="assets/images/check-list.png">
                        <p>สถานะการเรียน</p>
                    </a>
                </div>
            </div>
        </div>
    </div> -->

    <!--   <div class="container">
        <div class="page-cover">
            <div class="image-slider">
                @foreach($img as $item)
                <div class="slide">
                    <a href="{{ $item->imgslide_link }}">
                        <img src="{{asset('images/uploads/imgslides/'.$item->imgslide_picture)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            @if(count($img) > 1)
            <button class="prev" onclick="moveSlide(-1)">&#9664; </button>
            <button class="next" onclick="moveSlide(1)"> &#9654;</button>
            @else

            @endif
        </div>
        <script>
            let slideIndex = 0;
            const slides = document.querySelectorAll('.slide');

            function showSlides(n) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[n].classList.add('active');
            }

            function moveSlide(step) {
                slideIndex += step;
                if (slideIndex >= slides.length) slideIndex = 0;
                if (slideIndex < 0) slideIndex = slides.length - 1;
                showSlides(slideIndex);
            }

            // เริ่มต้นแสดงสไลด์แรก
            showSlides(slideIndex);
        </script>

        <div class="col-lg-4 col-md-4 box-video login pd-20">

            <h2 class="title-layout"><span>วีดีโอแนะนำ</span> </h2>
            <video width="100%" controls="">
                <source src=" {{asset('themes/bws/video/brother-video-1.mp4')}}" type="video/mp4">
                <source src="mov_bbb.ogg" type="video/ogg">
                Your browser does not support HTML5 video.
            </video>

            <h2 class="title-layout"><span>เกี่ยวกับบริษัท</span> </h2>

            <div class="group-link">
                <div class="depart-well-regis">
                    <a href="{{route('contactus_f')}}"> ติดต่อเรา </a>
                </div>
                <div class="depart">
                    <a href="{{route('conditions')}}"> เงื่อนไขการใช้งาน </a>
                </div>
            </div>
        </div>
    </div> -->
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // ดึงค่าจาก Session ที่ Controller ส่งมาผ่าน Blade
        const receivedToken = "{{ session('api_token') }}";

        if (receivedToken) {
            // เก็บลง LocalStorage เพื่อใช้ในหน้าอื่นๆ
            localStorage.setItem('api_access_token', receivedToken);
        }
    });
    document.getElementById('search').addEventListener('keyup', async function() {
        const query = this.value.trim();

        // ถ้า query ว่าง ให้ล้างผลลัพธ์
        if (query.length === 0) {
            document.getElementById('results').innerHTML = '';
            document.getElementById('result-count').innerHTML = '';
            return;
        }

        try {
            const res = await fetch(`/ocr/search?q=${encodeURIComponent(query)}`);
            if (!res.ok) throw new Error(`HTTP ${res.status}`);

            const data = await res.json();
            const hits = data.data || []; // ดึง array ของผลลัพธ์จาก data.data

            // แสดงจำนวนผลลัพธ์
            document.getElementById('result-count').innerHTML = `<h5 class="title-layout">พบ ${hits.length} ผลลัพธ์ที่ตรงกับ <span style="color:red">"${query}"</span></h5>`;

            let html = '';

            hits.forEach(hit => {
                let text = hit.highlight_text ?? hit.text; // ใช้ highlight_text ถ้ามี

                const pdfBaseUrl = '/images/uploads/ocr';
                const pdfUrl = `${pdfBaseUrl}/${hit.folder_name}/${hit.filename}#page=${hit.page_number}`;
                const filename = hit.highlight_filename ?? hit.filename ?? '-';

                html += `<div style="padding:5px; border-bottom:1px solid #ccc;">
                            <strong>ชื่อเอกสาร:</strong> ${filename}<br>
                            <strong>หน้าที่:</strong> ${hit.page_number || '-'}<br>
                            <strong>บรรทัด:</strong> ${text}<br>
                            <a href="${pdfUrl}" class="btn btn-primary btn-lg paper-shadow relative" target="_blank" style="color: white !important; text-decoration: underline !important;">
                                เปิดเอกสาร หน้า ${hit.page_number}
                            </a>
                        </div>`;
            });

            document.getElementById('results').innerHTML = html;

        } catch (err) {
            console.error('Search failed', err);
            document.getElementById('results').innerHTML = '<div style="color:red;">Search failed</div>';
            document.getElementById('result-count').innerHTML = '';
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection