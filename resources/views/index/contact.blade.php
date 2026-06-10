@extends('layout/mainlayout')
@section('title', 'Brother e-learning')
@section('content')

<style>
    a,
    a:hover,
    a:focus {
        color: #000000;
        text-decoration: none !important;
        outline: none !important;
    }

    /* --- Navbar (Pure CSS Flexbox) --- */
    .custom-header {
        background-color: #ffffff;
        border-bottom: 1px solid #eef0f3;
        padding: 16px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .brand-logo {
        height: 50px;
    }

    .nav-menu-center {
        display: flex;
        align-items: center;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .nav-menu-center li a {
        font-size: 17px;
        font-weight: 400;
        margin: 0 15px;
        transition: color 0.2s;
    }

    .nav-menu-center li a:hover,
    .nav-menu-center li.active a {
        color: #0c3b88;
        font-weight: 500;
    }

    .nav-home-icon {
        font-size: 18px;
        color: #4361ee !important;
    }

    .profile-pill {
        background-color: #0c3b88;
        color: #ffffff !important;
        border-radius: 50px;
        padding: 6px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }

    .profile-avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        object-fit: cover;
        margin-left: 8px;
    }

    /* --- Content Layout --- */
    .page-sidebar-title {
        padding: 30px 40px 10px 40px;
        font-size: 20px;
        color: #111111;
    }

    .page-main-title {
        font-size: 28px;
        font-weight: 500;
        text-align: center;
        margin-top: 10px;
        margin-bottom: 40px;
    }

    /* โครงสร้างโซนติดต่อแบ่งซ้าย-ขวา */
    .contact-info-container {
        max-width: 1000px;
        margin: 0 auto 30px auto;
        display: flex;
        gap: 30px;
        padding: 0 15px;
    }

    .contact-image-box {
        flex: 1;
    }

    .contact-image-box img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* กล่องข้อมูลฝั่งขวา */
    .contact-card-box {
        flex: 1;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 35px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .info-row {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
    }

    .info-row i {
        font-size: 20px;
        color: #00b4d8;
        /* สีฟ้าสว่างตามดีไซน์ */
        margin-right: 15px;
        margin-top: 3px;
        width: 25px;
        text-align: center;
    }

    .info-text h4 {
        margin: 0 0 5px 0;
        color: #00b4d8;
        font-size: 16px;
        font-weight: 500;
    }

    .info-text p {
        margin: 0;
        color: #333333;
        font-size: 14px;
        line-height: 1.6;
    }

    /* โซเชียลมีเดียไอคอนด้านล่างขวา */
    .social-icons-wrap {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 10px;
    }

    .social-btn {
        font-size: 22px;
        transition: opacity 0.2s;
    }

    .social-btn:hover {
        opacity: 0.8;
    }

    .social-btn.fb {
        color: #1877f2;
    }

    .social-btn.x {
        color: #000000;
    }

    .social-btn.yt {
        color: #ff0000;
    }

    /* --- โซนแผนที่ (Map Section) --- */
    .map-section-container {
        max-width: 1000px;
        margin: 0 auto 100px auto;
        padding: 0 15px;
    }

    .map-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    /* สไตล์จำลองภาพแผนที่ หรือจะใส่ iframe ของ Google Maps จริงๆ ตรงนี้ได้เลย */
    .map-display-area {
        width: 100%;
        height: 400px;
        background-image: url('https://www.toyoseikan.co.th/img/map.jpg');
        background-size: cover;
        background-position: center;
        position: relative;

    }

    .map-footer-btn-wrapper {
        background-color: #ffffff;
        padding: 15px;
        text-align: center;
        border-top: 1px solid #e0e0e0;
    }

    /* ปุ่มดาวน์โหลดสีน้ำเงินตามภาพ */
    .btn-download-map {
        background-color: #1565c0;
        color: #ffffff !important;
        font-family: 'Prompt', sans-serif;
        font-size: 14px;
        font-weight: 400;
        padding: 8px 24px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        transition: background-color 0.2s;
    }

    .btn-download-map:hover {
        background-color: #0d47a1;
    }

    .brand-logo {
        width: 65px;
        height: auto;
        display: block;
    }
</style>

<body>

    <div class="main-content">
        <div class="container-fluid">

            <div class="page-sidebar-title">
                <span>ติดต่อเรา</span>
            </div>

            <div class="container-fluid">

                <h2 class="page-main-title">ติดต่อเรา</h2>

                <div class="contact-info-container">

                    <div class="contact-image-box">
                        <img src="https://www.toyoseikan.co.th/boffice/picdata/page/companyEGG9plant1.jpg" alt="Toyo Seikan Thailand Office">
                    </div>

                    <div class="contact-card-box">
                        <div>
                            <div class="info-row">
                                <i class="fa-solid fa-location-dot"></i>
                                <div class="info-text">
                                    <h4>ที่ตั้ง</h4>
                                    <p>95 หมู่ 3, สวนอุตสาหกรรมโรจนะ 2,<br>ตำบล บ้านช้าง, อำเภอ อุทัย,<br>จังหวัด พระนครศรีอยุธยา 13210 ประเทศไทย</p>
                                </div>
                            </div>

                            <div class="info-row">
                                <i class="fa-solid fa-envelope"></i>
                                <div class="info-text">
                                    <h4>อีเมล</h4>
                                    <p>info@toyoseikan.co.th</p>
                                </div>
                            </div>

                            <div class="info-row" style="margin-bottom: 0;">
                                <i class="fa-solid fa-phone"></i>
                                <div class="info-text">
                                    <h4>โทรศัพท์</h4>
                                    <p>+66-35-746-655</p>
                                </div>
                            </div>
                        </div>

                        <div class="social-icons-wrap">
                            <a href="#" class="social-btn fb"><i class="fa-brands fa-circle-facebook"></i></a>
                            <a href="#" class="social-btn x"><i class="fa-brands fa-circle-x-twitter"></i></a>
                            <a href="#" class="social-btn yt"><i class="fa-brands fa-circle-youtube"></i></a>
                        </div>
                    </div>

                </div>

                <div class="map-section-container">
                    <div class="map-card">

                        <div class="map-display-area">

                        </div>

                        <div class="map-footer-btn-wrapper">
                            <button class="btn-download-map">
                                ดาวน์โหลดแผนที่ <i class="fa-solid fa-circle-arrow-down"></i>
                            </button>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

</body>


<script>

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
