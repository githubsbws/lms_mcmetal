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
        /* --- Pure CSS Custom Reset & Typography --- */
        /*    body {
            font-family: 'Prompt', sans-serif;
            background-color: #fcfcfc;
            color: #000000;
            margin: 0;
            padding: 0;
        } */

        .navbar.navbar-size-large .navbar-nav>li>a {
            font-size: 24px !important;
        }

        a,
        a:hover,
        a:focus {
            color: #000000;
            text-decoration: none !important;
            outline: none !important;
        }

        /* --- Navbar (Pure CSS Flexbox บังคับขนาดโลโก้ใหญ่ตามที่ขอ) --- */
        .custom-header {
            background-color: #ffffff;
            border-bottom: 1px solid #eef0f3;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            width: 65px;
            height: auto;
            display: block;
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

        /* --- โซนภาพ Banner ขนาดใหญ่เต็มจอ --- */
        .hero-banner-container {
            width: 100%;
            overflow: hidden;
        }

        /*    .hero-banner-img {
            width: 100%;
            height: auto;
            display: block;
        }
     */
        /* --- โซนเมนูของเราด้านล่าง (Menu Section) --- */
        .menu-section {
            padding: 60px 40px;
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            align-items: flex-start;
            gap: 40px;
        }

        /* หัวข้อฝั่งซ้าย */
        .menu-title-block {
            display: inline-block;
        }

        .menu-title-block h3 {
            margin: 0;
            font-size: 45px;
            font-weight: 500;
            line-height: 1.2;
            color: #111111;

        }

        .menu-title-block p {
            margin: 5px 0 0 0;
            font-size: 45px;
            font-weight: 500;
            color: #2196f3;
            /* ไฮไลท์สีฟ้าคำว่า ของเรา */
        }

        /* กลุ่มกล่องเมนูฝั่งขวา (ใช้ Flex เพื่อความยืดหยุ่นในการจัดช่องไฟ) */
        /*   .menu-cards-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            flex: 1;
        }
     */
        /* สไตล์กล่องการ์ดพื้นฐาน */
        .menu-card {
            flex: 1;
            min-width: 200px;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            border: none;
        }

        .menu-card img {
            width: 30px !important;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
        }

        /* ปรับแต่งไอคอนขนาดใหญ่ตรงกลางกล่อง */
        .menu-card i {
            font-size: 40px;
        }

        .menu-card span {
            font-size: 22px;
            font-weight: bold;
            color: #222222;
        }

        /* 1. หลักสูตรของฉัน (สีชมพูอ่อน) */
        .card-pink {
            background-color: #fcebeb;
        }

        .card-pink i {
            color: #5e60ce;
        }

        /* สีไอคอนหน้าจอ */

        /* 2. เอกสารดาวน์โหลด (สีแดงส้ม - ตัวเด่น Active) */
        .card-red-active {
            background-color: #f07167;
            box-shadow: 0 4px 12px rgba(240, 113, 103, 0.2);
        }

        .card-red-active i {
            color: #ffffff;
        }

        .card-red-active span {
            color: #ffffff !important;
        }

        /* 3. วิธีการใช้งาน (สีครีมส้มอ่อน) */
        .card-cream {
            background-color: #fdf0d5;
        }

        .card-cream i {
            color: #d62828;
        }

        /* 4. สถานะการเรียน (สีเขียวพาสเทลอ่อน) */
        .card-green {
            background-color: #e8f5e9;
        }

        .card-green i {
            color: #2e7d32;
        }

        /* --- ส่วนเนื้อหาโซนรายวิชาหลักสูตรของเรา --- */
        .courses-wrapper {
            /*  max-width: 1200px;
            margin: 50px auto 100px auto; */
            /* padding: 0 15px; */
        }

        /* แถบหัวข้อด้านบนสุด */
        .courses-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .section-headline {
            font-size: 26px;
            font-weight: bold;
            position: relative;
            margin: 0;
            padding-bottom: 8px;
            color: #111111;
            border-bottom: 3px solid #2196f3;
        }

        /* เส้นใต้สีน้ำเงินหนาๆ ตามแบบ UI ดีไซน์ */
        /*    .section-headline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 188px;
            height: 4px;
            background-color: #2196f3;
            border-radius: 2px;
        } */

        /* ปุ่ม ดูทั้งหมด สีดำโค้งมน */
        .btn-view-all {
            background-color: #0a0a0f;
            color: #ffffff !important;
            font-size: 18px;
            padding: 8px 22px;
            border-radius: 20px;
            font-weight: 400;
            transition: opacity 0.2s;
        }

        .btn-view-all:hover {
            opacity: 0.85;
        }

        /* --- สไตล์กล่องการ์ดโมเดิร์น (Course Cards) --- */
        .course-card-item {
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            /* เงาฟุ้งลอยแบบนุ่มๆ */
            margin-bottom: 30px;
            border: 1px solid #f1f1f1;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .course-card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.09);
        }

        /* กล่องคุมพื้นที่รูปภาพ */
        .course-image-area {
            position: relative;
            width: 100%;
            height: 190px;
            overflow: hidden;
        }

        .course-image-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ป้ายบอกคะแนนดาวลอยตัวอยู่บนรูปภาพ */
        .star-rating-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            z-index: 2;
        }

        .star-rating-badge i {
            color: #ffb703;
            /* สีเหลืองทอง */
        }

        /* รายละเอียดเนื้อหาภายในการ์ด */
        .course-detail-body {
            padding: 20px;
        }

        .course-title {
            font-size: 22px;
            font-weight: 500;
            color: #111111;
            margin: 0 0 15px 0;
            line-height: 1.4;
            height: 44px;
            /* ล็อกไว้ 2 บรรทัดให้เท่ากันทุกกล่อง */
            overflow: hidden;
        }

        /* เม็ดยาแสดงสถิติ (บทเรียน / เวลา / นักเรียน) */
        .course-stats-row {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .stat-badge-pill {
            background-color: #f5f6f8;
            border: 1px solid #eef0f3;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            color: #555555;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .stat-badge-pill i {
            color: #777777;
        }

        /* แถบโปรไฟล์ผู้สอนด้านล่างสุด */
        .instructor-profile-footer {
            border-top: 1px solid #f1f1f1;
            padding-top: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .instructor-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
        }

        .instructor-name {
            font-size: 18px;
            font-weight: 500;
            color: #333333;
        }

        /* --- โซนเนื้อหาข่าวประชาสัมพันธ์ --- */
        .news-wrapper {
            padding: 40px 20px;
        }

        /* แถบหัวข้อด้านบนสุด */
        .news-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .section-headlines {
            font-size: 26px;
            font-weight: bold;
            position: relative;
            margin: 0;
            padding-bottom: 2px;
            color: #111111;
            border-bottom: 3px solid #2196f3;
        }

        /* เส้นใต้สีน้ำเงินหนาๆ ตามแบบ UI ดีไซน์ */
        /*  .section-headlines::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 210px;
            height: 4px;
            background-color: #2196f3;
            border-radius: 2px;
        } */


        /* --- สไตล์กล่องการ์ดข่าว (News Cards) --- */
        .news-card-item {
            position: relative;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            cursor: pointer;
        }

        .news-card-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* จัดความสูงของรูปภาพแยกตามขนาดกล่อง */
        .news-card-item.large-box {
            height: 340px;
        }

        .news-card-item.small-box {
            height: 340px;
        }

        .news-card-item.bottom-box {
            height: 260px;
        }

        .news-card-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- กล่องข้อความโปร่งแสงคาดด้านล่างรูปภาพ (Overlay Content) --- */
        .news-overlay-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.6) 70%, rgba(0, 0, 0, 0) 100%);
            padding: 20px 24px;
            color: #ffffff;
        }

        /* สำหรับกล่องแถวสองที่เตี้ยกว่า ให้ไล่เฉดสีเน้นเนื้อหาชัดๆ */
        .news-card-item.bottom-box .news-overlay-content {
            padding: 15px 20px;
        }

        .news-title {
            font-size: 22px;
            font-weight: 400;
            margin: 0 0 10px 0;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* จำกัดข้อความไว้ไม่เกิน 2 บรรทัด */
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #ffffff;
        }

        .news-card-item.large-box .news-title {
            font-size: 22px;
            /* ขยายฟอนต์หัวข้อบนกล่องใหญ่ */
        }

        /* โซนวันที่และเครดิตด้านล่างสุด */
        .news-meta-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-size: 12px;
            color: #cccccc;
        }

        .news-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 18px;
        }

        .news-meta-item i {
            font-size: 13px;
            color: #bbbbbb;
        }

        .cta-section {
            position: relative;
            width: 100%;
            min-height: 680px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: url('https://images.unsplash.com/photo-1710162734135-8dc148f53abe?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center center / cover no-repeat;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(235, 245, 255, 0.9) 0%, rgba(255, 255, 255, 0.85) 50%, rgba(255, 230, 240, 0.8) 100%);
            z-index: 1;
        }

        .cta-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            padding: 60px 20px;
        }

        .cta-title {
            font-size: 64px;
            font-weight: 600;
            line-height: 1.2;
            margin: 0 0 20px 0;
            color: #111111;
        }

        .cta-title .highlight {
            color: #2196f3;
            background-color: #ffffff00 !important;
        }

        .cta-description {
            font-size: 18px;
            color: #666666;
            line-height: 1.7;
            margin: 0 0 30px 0;
        }

        .cta-btn-contact {
            display: inline-block;
            padding: 10px 30px;
            border: 1.5px solid #111111;
            border-radius: 30px;
            font-size: 22px;
            font-weight: 400;
            color: #111111 !important;
            background-color: transparent;
            transition: all 0.2s;
        }

        .cta-btn-contact:hover {
            background-color: #111111;
            color: #ffffff !important;
        }

        @media (max-width: 767px) {
            .cta-section {
                min-height: 350px;
            }

            .cta-title {
                font-size: 30px;
            }

            .cta-description {
                font-size: 13px;
            }
        }

        .main-video-wrapper {
            max-width: 1200px;
            margin: 50px auto 60px auto;
            padding: 0 15px;
        }

        .main-video-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }

        .main-video-headline {
            font-size: 26px;
            position: relative;
            margin: 0;
            padding-bottom: 2px;
            color: #111111;
            font-weight: bold;
            border-bottom: 3px solid #2196f3;
        }

        /*   .main-video-headline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 140px;
            height: 4px;
            background-color: #2196f3;
            border-radius: 2px;
        } */

        .main-video-btn-all {
            background-color: #0a0a0f;
            color: #ffffff !important;
            font-size: 13px;
            padding: 8px 22px;
            border-radius: 20px;
            font-weight: 400;
            transition: opacity 0.2s;
        }

        .main-video-btn-all:hover {
            opacity: 0.85;
        }

        .main-video-card {
            border: 1px solid #000;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .main-video-card-iframe {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }

        .main-video-card-iframe iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .course-index {
            background-color: #F7F7F7;
            padding: 40px 20px;
        }

        @media (max-width: 767px) {
            .main-video-headline {
                font-size: 20px;
            }
        }

        .mymenu {
            display: flex;
            margin: 40px 0 40px 0;
            text-align: center;
            flex-direction: column;
        }

        .menu-cards-grid {
            display: flex;
            /* margin-top: 30px; */
            justify-content: center;
        }

        .custom-accordion-container {
            max-width: 850px;
            margin: 0 auto 100px auto;
            padding: 0 15px;
        }

        /* ล้างกรอบสีเทาเหลี่ยมๆ ของ BT3 Panel ออก */
        .panel-group#accordion .panel {
            background-color: #ffffff;
            border: 1px solid #e0e0e0 !important;
            border-radius: 8px !important;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
            overflow: hidden;
        }

        .panel-group#accordion .panel+.panel {
            margin-top: 0;
            /* เคลียร์ค่าทับซ้อนของ BT3 */
        }

        /* ส่วนหัวแถบคำถาม */
        .panel-group#accordion .panel-heading {
            background-color: #ffffff !important;
            padding: 0;
            border: none;
        }

        .panel-group#accordion .panel-title a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            font-size: 16px;
            font-weight: 400;
            width: 100%;
        }

        /* ไอคอนลูกศรเปลี่ยนทิศทางเมื่อเปิด-ปิด (พึ่งพาคลาสของ BT3) */
        .panel-group#accordion .panel-title a .chevron-icon {
            transition: transform 0.2s ease;
            font-size: 16px;
            color: #555;
        }

        /* ถ้าไม่ได้หดตัวอยู่ (คือเปิดอยู่) ให้หมุนลูกศรกลับหัว */
        .panel-group#accordion .panel-title a:not(.collapsed) .chevron-icon {
            transform: rotate(180deg);
        }

        /* ส่วนกล่องคำตอบ */
        .panel-group#accordion .panel-collapse {
            border: none !important;
        }

        .panel-group#accordion .panel-body {
            border-top: none !important;
            /* ลบเส้นคั่นดีฟอลต์ของ BT3 */
            padding: 0 24px 24px 24px;
            font-size: 14px;
            color: #333333;
            line-height: 1.7;
        }

        .faq-text-block {
            margin-bottom: 12px;
        }

        .question-index {
            padding: 40px 0;
        }

        .question-index {
            padding: 40px 0;

            h2 {
                margin: 0 0 20px 0 !important;
            }

            .panel-collapse {
                text-align: start;
            }
        }

        /*     @media (min-width: 768px) and (min-width: 992px) {
            .navbar.navbar-size-large .navbar-nav-margin-left {
                margin-left: 200px !important;
            }
        } */

        .navbar.navbar-size-large .navbar-nav>li>a {
            font-size: 20px;
        }

        /*  #main-nav {
            display: flex !important;
            justify-content: center;
            position: relative !important;

            .navbar-right {
                position: absolute;
                right: 0;
            }
        }

        .user a {
            height: auto !important;
            background-color: #093880;
            display: inline !important;
            padding: 16px !important;
            border-radius: 26px;
            color: #fff !important;
        } */

        .main-video-wrapper {
            max-width: 1200px;
            margin: 50px auto 60px auto;
            padding: 0 15px;
        }

        .main-video-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
        }




        .main-video-btn-all {
            background-color: #0a0a0f;
            color: #ffffff !important;
            font-size: 13px;
            padding: 8px 22px;
            border-radius: 20px;
            font-weight: 400;
            transition: opacity 0.2s;
        }

        .main-video-btn-all:hover {
            opacity: 0.85;
        }

        .main-video-card {
            border: 1px solid #000;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .main-video-card-iframe {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }

        .main-video-card-iframe iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        @media (max-width: 767px) {
            .main-video-headline {
                font-size: 20px;
            }
        }

        .main-video {
            padding: 40px 20px;
        }

        /* คำถามที่พบบ่อย */
        .page-sidebar-title {
            padding: 30px 40px 10px 40px;
            font-size: 20px;
            color: #111111;
        }

        .page-main-title {
            font-size: 26px;
            font-weight: 500;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 40px;
        }

        /* --- ตกแต่งทับ Collapse/Accordion ของ Bootstrap 3 ให้โมเดิร์น --- */
        .custom-accordion-container {
            max-width: 850px;
            margin: 0 auto 100px auto;
            padding: 0 15px;
        }

        /* ล้างกรอบสีเทาเหลี่ยมๆ ของ BT3 Panel ออก */
        .panel-group#accordion .panel {
            background-color: #ffffff;
            border: 1px solid #e0e0e0 !important;
            border-radius: 8px !important;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
            overflow: hidden;
        }

        .panel-group#accordion .panel+.panel {
            margin-top: 0;
            /* เคลียร์ค่าทับซ้อนของ BT3 */
        }

        /* ส่วนหัวแถบคำถาม */
        .panel-group#accordion .panel-heading {
            background-color: #ffffff !important;
            padding: 0;
            border: none;
        }

        .panel-group#accordion .panel-title a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            font-size: 16px;
            font-weight: 400;
            width: 100%;
        }

        /* ไอคอนลูกศรเปลี่ยนทิศทางเมื่อเปิด-ปิด (พึ่งพาคลาสของ BT3) */
        .panel-group#accordion .panel-title a .chevron-icon {
            transition: transform 0.2s ease;
            font-size: 16px;
            color: #555;
        }

        /* ถ้าไม่ได้หดตัวอยู่ (คือเปิดอยู่) ให้หมุนลูกศรกลับหัว */
        .panel-group#accordion .panel-title a:not(.collapsed) .chevron-icon {
            transform: rotate(180deg);
        }

        /* ส่วนกล่องคำตอบ */
        .panel-group#accordion .panel-collapse {
            border: none !important;
        }

        .panel-group#accordion .panel-body {
            border-top: none !important;
            /* ลบเส้นคั่นดีฟอลต์ของ BT3 */
            padding: 0 24px 24px 24px;
            font-size: 14px;
            color: #333333;
            line-height: 1.7;
        }

        .faq-text-block {
            margin-bottom: 12px;
        }
    </style>

    <body>
        <div class="main-content">
            <section class="hero-banner-container">
                <img src="{{ asset('assets/images/banner.png') }}" alt="E-Learning Banner" class="hero-banner-img"
                    style="width: 100%;">
            </section>

            @if (Auth::user())
                <div class="container-fluid">
                    <div class="row" style="display: flex; align-items: center; padding: 3rem 0;">
                        <div class="col-lg-2">
                            <div class="menu-title-block">
                                <h3>เมนู</h3>
                                <p>ของเรา</p>
                            </div>
                        </div>

                        <div class="col-lg-10">
                            <div class="menu-cards-grid">
                                <div class="row" style="width: 100%;">
                                    <div class=" col-lg-4">
                                        <a href="{{ url('course') }}">
                                            <div class="menu-card card-pink" onclick="location.href='#'">
                                                <img src="{{ asset('assets/images/menu1.png') }}" alt="E-Learning Banner"
                                                    class="hero-banner-img">
                                                <span>หลักสูตรของฉัน</span>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="menu-card card-cream" onclick="location.href='#'">
                                            <img src="{{ asset('assets/images/user-guide.png') }}" alt="E-Learning Banner"
                                                class="hero-banner-img">
                                            <span>วิธีการใช้งาน</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <a href="{{ url('course') }}">
                                            <div class="menu-card card-green" onclick="location.href='#'">
                                                <img src="{{ asset('assets/images/check-list.png') }}"
                                                    alt="E-Learning Banner" class="hero-banner-img">
                                                <span>สถานะการเรียน</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::user())
                <div class="container-fluid course-index">
                    <div class="courses-wrapper">

                        <div class="courses-top-bar">
                            <h3 class="section-headline">หลักสูตรของเรา</h3>
                            <!-- <a href="#" class="btn-view-all">ดูทั้งหมด</a> -->
                        </div>

                        <div class="row">
                            @if ($course_detail->isNotEmpty())
                                @foreach ($course_detail as $course)
                                    <a href="{{ url('course') }}">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="course-card-item">
                                                <div class="course-image-area">
                                                    <img src="{{ asset('images/uploads/courseonline/' . $course->course_id . '/original/' . $course->course_picture) }}"
                                                        alt="Course Cover" loading="lazy">
                                                </div>
                                                <div class="course-detail-body">
                                                    <h4 class="course-title">{{ $course->course_title }}</h4>
                                                    <div class="instructor-profile-footer">
                                                        <span class="instructor-name">ผู้สอน:
                                                            {{ $course->teacher->teacher_name ?? '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <h3>ยังไม่มีหลักสูตรในสายงานของคุณ</h3>
                            @endif
                        </div>
                    </div>
                </div>
            @endif


            <div class="container-fluid">
                <div class="news-wrapper">

                    <div class="news-top-bar">
                        <h3 class="section-headlines">ข่าวประชาสัมพันธ์</h3>
                        <a href="{{ url('new') }}" class="btn-view-all">ดูทั้งหมด</a>
                    </div>

                    <div class="row">
                        @if ($news_desc->isNotEmpty())
                            @foreach ($news_desc as $news)
                                @if ($loop->first)
                                    <a href="{{ route('new_detail', $news->cms_id) }}">
                                        <div class="col-md-8 col-sm-12">
                                            <div class="news-card-item large-box">
                                                <img src="{{ asset('images/uploads/news/' . $news->cms_id . '/original/' . $news->cms_picture) }}"
                                                    alt="News Image 1" loading="lazy">
                                                <div class="news-overlay-content">
                                                    <h4 class="news-title">{!! trim(strip_tags(html_entity_decode($news->cms_short_title))) ?: '-' !!}</h4>
                                                    <div class="news-meta-info">
                                                        <span class="news-meta-item"><i
                                                                class="fa-regular fa-calendar"></i>{{ $news->create_date ? \Carbon\Carbon::parse($news->create_date)->locale('th')->isoFormat('D MMMM') . ' ' . (\Carbon\Carbon::parse($news->create_date)->year + 543) : '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ route('new_detail', $news->cms_id) }}">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="news-card-item small-box">
                                                <img src="{{ asset('images/uploads/news/' . $news->cms_id . '/original/' . $news->cms_picture) }}"
                                                    alt="News Image 2" loading="lazy">
                                                <div class="news-overlay-content">
                                                    <h4 class="news-title">{!! trim(strip_tags(html_entity_decode($news->cms_short_title))) ?: '-' !!}</h4>
                                                    <div class="news-meta-info">
                                                        <span class="news-meta-item"><i
                                                                class="fa-regular fa-calendar"></i>{{ $news->create_date ? \Carbon\Carbon::parse($news->create_date)->locale('th')->isoFormat('D MMMM') . ' ' . (\Carbon\Carbon::parse($news->create_date)->year + 543) : '-' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <h3>ไม่มีข่าวสารในตอนนี้ กรุณาติดตามรอ</h3>
                        @endif
                    </div>
                </div>
            </div>

            <section class="cta-section">
                <div class="cta-content">
                    <h2 class="cta-title">Learn and Grow with<br>Top <span class="highlight">Online Courses</span></h2>
                    <p class="cta-description">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    </p>
                    <a href="#" class="cta-btn-contact">Contact Us</a>
                </div>
            </section>


            <div class="container-fluid">
                <div class="main-video">
                    <div class="main-video-top-bar">
                        <h3 class="main-video-headline">วิดีโอแนะนำ</h3>
                        <!-- <a href="#" class="main-video-btn-all">ดูทั้งหมด</a> -->
                    </div>
                    <div class="row">
                        <!-- Video 1 -->
                        <div class="col-md-4 col-sm-6">
                            <div class="main-video-card">
                                <div class="main-video-card-iframe">
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        <!-- Video 2 -->
                        <div class="col-md-4 col-sm-6">
                            <div class="main-video-card">
                                <div class="main-video-card-iframe">
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        <!-- Video 3 -->
                        <div class="col-md-4 col-sm-6">
                            <div class="main-video-card">
                                <div class="main-video-card-iframe">
                                    <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/njX2bu-_Vw4?si=Kt3_fLnGoNYKIbCU"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="container-fluid">

                <h2 class="page-main-title">คำถามที่พบบ่อย</h2>

                <div class="custom-accordion-container">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        1. การเรียน/สอบ ผ่านระบบ E-Learning
                                        <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse " role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="faq-text-block">
                                        1. "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." </div>
                                    <div class="faq-text-block">
                                        2. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those
                                        interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        2. ลืมรหัสผ่าน
                                        <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat."

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        3. วิธีแจ้งปัญหาการใช้งาน
                                        <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingThree">
                                <div class="panel-body">
                                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat."

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        4. สามารถใช้งานภาษาอะไรได้บ้าง
                                        <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingFour">
                                <div class="panel-body">
                                    "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat."

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
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
                document.getElementById('result-count').innerHTML =
                    `<h5 class="title-layout">พบ ${hits.length} ผลลัพธ์ที่ตรงกับ <span style="color:red">"${query}"</span></h5>`;

                let html = '';

                hits.forEach(hit => {
                    let text = hit.highlight_text ?? hit.text; // ใช้ highlight_text ถ้ามี

                    const pdfBaseUrl = '/images/uploads/ocr';
                    const pdfUrl =
                        `${pdfBaseUrl}/${hit.folder_name}/${hit.filename}#page=${hit.page_number}`;
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
