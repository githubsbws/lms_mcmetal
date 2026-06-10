<?php include 'includes/header.php'; ?>

<style>
    .timeline-wrapper {
        position: relative;
        z-index: 1;
    }

    /* เส้น timeline */
    .timeline-line {
        position: absolute;
        top: 50px;
        left: 0;
        right: 0;
        height: 4px;
        background: #dbe4f0;
        z-index: 1;
    }

    /* item */
    .timeline-item {
        position: relative;
        z-index: 2;

        li {
            position: relative;
            z-index: 2;
            list-style: none;
            padding: 0;
        }

        button {
            border: none !important;
        }
    }

    /* icon */
    .icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: white;
        font-size: 24px;
    }

    /* สี */
    .pink {
        background: #ff4f8b;
    }

    .blue {
        background: #5b9cff;
    }

    .orange {
        background: #ffa552;
    }

    /* mobile */
    @media (max-width: 768px) {
        .timeline-wrapper svg {
            display: none;
        }

        .timeline-item {
            margin-bottom: 30px;
        }
    }

    .wrapsec1 {
        display: flex;
        justify-content: space-between;
    }

    .wrapsec1 .group {
        margin-right: 221px;
    }

    .item1 {
        display: flex;
        justify-content: flex-start;
        column-gap: 57px;
    }

    .timeline-wrapper svg {
        position: absolute;
        z-index: -1;
    }

    .item2 .row {
        justify-content: end;
    }

    .roadmap-center {
        flex-direction: row-reverse;
        display: flex;
        column-gap: 17px;
    }


    .green {
        background: #2CD776;
    }
</style>




<main class="container-fluid">

    <div class="course-content">
        <div class="row">
            <div class="col-lg-5 roadmap">

                <div class="title">
                    <span class="title1">road<span class="title2">map</span></span>
                </div>

                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <div class="road">
                            <button class="nav-link active " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <p class="number">01</p>
                                <div class="line"></div>
                                <div class="wrap">
                                    <div class="couurse-name-rd">
                                        <p>การผลิต บรรจุภัณฑ์พลาสติก ผลิตภัณฑ์เครื่องดื่ม
                                            การวิจัยและพัฒนา</p>
                                        <p>การผลิต บรรจุภัณฑ์พลาสติก ผลิตภัณฑ์เครื่องดื่ม </p>
                                    </div>

                                    <div class="icon">
                                        <i class="fa-regular fa-circle-check"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="road">
                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <p class="number">02</p>
                                <div class="line"></div>
                                <div class="wrap">
                                    <div class="couurse-name-rd">
                                        <p>การอบรม การวิจัยและพัฒนาเทคนิคด้านนวัตกรรม</p>
                                        <p>ให้การสนับสนุนทางเทคนิคด้านนวัตกรรมเครื่องดื่มและบรรจุภัณฑ์ </p>
                                    </div>

                                    <div class="icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="road">
                            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <p class="number">03</p>
                                <div class="line"></div>
                                <div class="wrap">
                                    <div class="couurse-name-rd">
                                        <p>การอบรมระบบบรรจุเครื่องดื่มแบบปลอดเชื้อ </p>
                                        <p>การอบรมระบบบรรจุเครื่องดื่มแบบปลอดเชื้อ (Aseptic Filling System Introduction) </p>
                                    </div>

                                    <div class="icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <div class="road">
                            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages4" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <p class="number">04</p>
                                <div class="line"></div>
                                <div class="wrap">
                                    <div class="couurse-name-rd">
                                        <p>การอบรม การผลิต บรรจุภัณฑ์พลาสติก Common200 (Lamicon)</p>
                                        <p>การอบรม การผลิต บรรจุภัณฑ์พลาสติก Common200 (Lamicon) </p>
                                    </div>

                                    <div class="icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                </div>
                            </button>
                        </div>

                        <div class="road">
                            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages5" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <p class="number">05</p>
                                <div class="line"></div>
                                <div class="wrap">
                                    <div class="couurse-name-rd">
                                        <p>การอบรม บรรจุภัณฑ์สำหรับผลิตภัณฑ์ดูแลครัวเรือน</p>
                                        <p>การอบรมบรรจุภัณฑ์พลาสติก บรรจุภัณฑ์สำหรับผลิตภัณฑ์ดูแลครัวเรือน </p>
                                    </div>

                                    <div class="icon">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </div>
                                </div>
                            </button>
                        </div>



                    </div>
                </div>

                <nav aria-label="Page navigation example mt-3">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-angle-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i class="fa-solid fa-angle-right"></i></a></li>
                    </ul>
                </nav>



            </div>
            <div class="col-lg-7">
                <div class="course-wrap">
                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="card-main mb-3">
                                <img class="w-100" src="assets/images/course1.png" alt="" srcset="">
                                <div class="card-body">
                                    <h3>การผลิต บรรจุภัณฑ์พลาสติก ผลิตภัณฑ์เครื่องดื่ม การวิจัยและพัฒนา</h3>
                                    <progress class="progressbar-inp" value="100" max="100"> 100% </progress>
                                    <h5 class="card-title">100 % สำเร็จ</h5>
                                    <div class="admin-course">

                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>เจ้าของหลักสูตร :</td>
                                                    <td>คุณทวี เสริมศิล</td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้อนุมัติหลักสูตร :</td>
                                                    <td>คุณวิรัช กิจเตชะการ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="period-day">
                                <p>Period 10 Day (14 / jul / 2022 - 24 Dec / 2026)</p>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">ระยะเวลา</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/clock.png" alt="" srcset="">
                                            <p class="mx-0">2 ชั่วโมง</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">จำนวนบทเรียน</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/book.png" alt="" srcset="">
                                            <p class="mx-0">4 บทเรียน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">สถานะ Certificate</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer1.png" alt="" srcset="">
                                            <p class="mx-0">ยังไม่ผ่านเงื่อนไข</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">แบบประเมินหลักสูตร</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer2.png" alt="" srcset="">
                                            <p class="mx-0">ทำแบบประเมิน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="course-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="course-detail" data-bs-toggle="tab" data-bs-target="#nav1" type="button" role="tab" aria-controls="nav1" aria-selected="true">รายละเอียดหลักสูตร</button>
                                        <button class="nav-link" id="course-list" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" tabindex="-1">รายการหลักสูตร</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav1" role="tabpanel" aria-labelledby="course-detail">
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                        <br>
                                        <br>
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                    </div>

                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="course-list">
                                        <div class="course-list">
                                            <div class="list-top">
                                                <div>
                                                    <span>บทที่ 1</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary d-flex"><img width="24px" class="mx-1" src="assets/images/download-doc.png" alt="" srcset="">เอกสารประกอบการเรียน</button>
                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>15/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 1</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 2</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>


                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>15/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 2</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 3</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>


                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>15/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 3</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                             <div class="list-second">
                                                <div>
                                                    <span>บทที่ 4</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>


                                             <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>15/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 4</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                            <div class="card-main mb-3">
                                <img class="w-100" src="assets/images/course2.png" alt="" srcset="">
                                <div class="card-body">
                                    <h3>การอบรม การวิจัยและพัฒนาเทคนิคด้านนวัตกรรม</h3>
                                    <progress class="progressbar-inp" value="70" max="100"> 70% </progress>
                                    <h5 class="card-title">70 % กำลังเรียน</h5>
                                    <div class="admin-course">

                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>เจ้าของหลักสูตร :</td>
                                                    <td>คุณทวี เสริมศิล</td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้อนุมัติหลักสูตร :</td>
                                                    <td>คุณวิรัช กิจเตชะการ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="period-day">
                                <p>Period 30 Day (14 / jul / 2026 - 24 Dec / 2026)</p>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">ระยะเวลา</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/clock.png" alt="" srcset="">
                                            <p class="mx-0">2 ชั่วโมง</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">จำนวนบทเรียน</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/book.png" alt="" srcset="">
                                            <p class="mx-0">4 บทเรียน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">สถานะ Certificate</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer1.png" alt="" srcset="">
                                            <p class="mx-0">ยังไม่ผ่านเงื่อนไข</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">แบบประเมินหลักสูตร</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer2.png" alt="" srcset="">
                                            <p class="mx-0">ทำแบบประเมิน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="course-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab2" role="tablist">
                                        <button class="nav-link active" id="course-detail" data-bs-toggle="tab" data-bs-target="#nav5" type="button" role="tab" aria-controls="nav5" aria-selected="true">รายละเอียดหลักสูตร</button>
                                        <button class="nav-link" id="course-list" data-bs-toggle="tab" data-bs-target="#nav6" type="button" role="tab" aria-controls="nav6" aria-selected="false" tabindex="-1">รายการหลักสูตร</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav5" role="tabpanel" aria-labelledby="course-detail">
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                        <br>
                                        <br>
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                    </div>

                                    <div class="tab-pane fade" id="nav6" role="tabpanel" aria-labelledby="course-list">
                                        <div class="course-list">
                                            <div class="list-top">
                                                <div>
                                                    <span>บทที่ 1</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary d-flex"><img width="24px" class="mx-1" src="assets/images/download-doc.png" alt="" srcset="">เอกสารประกอบการเรียน</button>
                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>8/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 1</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 2</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 2</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 3</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 3</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>


                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 4</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 4</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                            <div class="card-main mb-3">
                                <img class="w-100" src="assets/images/course6.jpg" alt="" srcset="">
                                <div class="card-body">
                                    <h3>การอบรมระบบบรรจุเครื่องดื่มแบบปลอดเชื้อ (Aseptic Filling System Introduction) </h3>
                                    <progress class="progressbar-inp" value="80" max="100"> 80% </progress>
                                    <h5 class="card-title">80 % กำลังเรียน</h5>
                                    <div class="admin-course">

                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>เจ้าของหลักสูตร :</td>
                                                    <td>คุณทวี เสริมศิล</td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้อนุมัติหลักสูตร :</td>
                                                    <td>คุณวิรัช กิจเตชะการ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="period-day">
                                <p>Period 03 Day (14 / jul / 2022 - 24 Dec / 2026)</p>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">ระยะเวลา</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/clock.png" alt="" srcset="">
                                            <p class="mx-0">2 ชั่วโมง</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">จำนวนบทเรียน</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/book.png" alt="" srcset="">
                                            <p class="mx-0">4 บทเรียน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">สถานะ Certificate</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer1.png" alt="" srcset="">
                                            <p class="mx-0">ยังไม่ผ่านเงื่อนไข</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">แบบประเมินหลักสูตร</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer2.png" alt="" srcset="">
                                            <p class="mx-0">ทำแบบประเมิน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="course-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab2" role="tablist">
                                        <button class="nav-link active" id="course-detail" data-bs-toggle="tab" data-bs-target="#nav8" type="button" role="tab" aria-controls="nav8" aria-selected="true">รายละเอียดหลักสูตร</button>
                                        <button class="nav-link" id="course-list" data-bs-toggle="tab" data-bs-target="#nav9" type="button" role="tab" aria-controls="nav9" aria-selected="false" tabindex="-1">รายการหลักสูตร</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav8" role="tabpanel" aria-labelledby="course-detail">
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                        <br>
                                        <br>
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                    </div>

                                    <div class="tab-pane fade" id="nav9" role="tabpanel" aria-labelledby="course-list">
                                        <div class="course-list">
                                            <div class="list-top">
                                                <div>
                                                    <span>บทที่ 1</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary d-flex"><img width="24px" class="mx-1" src="assets/images/download-doc.png" alt="" srcset="">เอกสารประกอบการเรียน</button>
                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>8/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 1</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 2</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 2</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 3</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 3</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>


                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 4</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 4</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="tab-pane fade" id="v-pills-messages4" role="tabpanel" aria-labelledby="v-pills-messages4-tab">

                            <div class="card-main mb-3">
                                <img class="w-100" src="assets/images/course4.png" alt="" srcset="">

                                <div class="card-body">
                                    <h3>การอบรม การผลิต บรรจุภัณฑ์พลาสติก Common200 (Lamicon) </h3>
                                    <progress class="progressbar-inp" value="40" max="100"> 40% </progress>
                                    <h5 class="card-title">40 % กำลังเรียน</h5>
                                    <div class="admin-course">

                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>เจ้าของหลักสูตร :</td>
                                                    <td>คุณทวี เสริมศิล</td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้อนุมัติหลักสูตร :</td>
                                                    <td>คุณวิรัช กิจเตชะการ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="period-day">
                                <p>Period 16 Day (14 / jul / 2025 - 24 Dec / 2026)</p>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">ระยะเวลา</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/clock.png" alt="" srcset="">
                                            <p class="mx-0">2 ชั่วโมง</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">จำนวนบทเรียน</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/book.png" alt="" srcset="">
                                            <p class="mx-0">4 บทเรียน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">สถานะ Certificate</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer1.png" alt="" srcset="">
                                            <p class="mx-0">ยังไม่ผ่านเงื่อนไข</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">แบบประเมินหลักสูตร</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer2.png" alt="" srcset="">
                                            <p class="mx-0">ทำแบบประเมิน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="course-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab2" role="tablist">
                                        <button class="nav-link active" id="course-detail" data-bs-toggle="tab" data-bs-target="#nav10" type="button" role="tab" aria-controls="nav10" aria-selected="true">รายละเอียดหลักสูตร</button>
                                        <button class="nav-link" id="course-list" data-bs-toggle="tab" data-bs-target="#nav11" type="button" role="tab" aria-controls="nav11" aria-selected="false" tabindex="-1">รายการหลักสูตร</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav10" role="tabpanel" aria-labelledby="course-detail">
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                        <br>
                                        <br>
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                    </div>

                                    <div class="tab-pane fade" id="nav11" role="tabpanel" aria-labelledby="course-list">
                                        <div class="course-list">
                                            <div class="list-top">
                                                <div>
                                                    <span>บทที่ 1</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary d-flex"><img width="24px" class="mx-1" src="assets/images/download-doc.png" alt="" srcset="">เอกสารประกอบการเรียน</button>
                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>8/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 1</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 2</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 2</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 3</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 4</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>


                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 4</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 4</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="tab-pane fade" id="v-pills-messages5" role="tabpanel" aria-labelledby="v-pills-messages5-tab">

                            <div class="card-main mb-3">
                                <img class="w-100" src="assets/images/course5.png" alt="" srcset="">
                                <div class="card-body">
                                    <h3>การอบรมบรรจุภัณฑ์พลาสติก บรรจุภัณฑ์สำหรับผลิตภัณฑ์ดูแลครัวเรือน</h3>
                                    <progress class="progressbar-inp" value="50" max="100"> 50% </progress>
                                    <h5 class="card-title">50 % กำลังเรียน</h5>
                                    <div class="admin-course">

                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>เจ้าของหลักสูตร :</td>
                                                    <td>คุณทวี เสริมศิล</td>
                                                </tr>
                                                <tr>
                                                    <td>ผู้อนุมัติหลักสูตร :</td>
                                                    <td>คุณวิรัช กิจเตชะการ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="period-day">
                                <p>Period 23 Day (17 / jul / 2022 - 24 Dec / 2026)</p>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">ระยะเวลา</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/clock.png" alt="" srcset="">
                                            <p class="mx-0">2 ชั่วโมง</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">จำนวนบทเรียน</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/book.png" alt="" srcset="">
                                            <p class="mx-0">4 บทเรียน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-main mb-5">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0">สถานะ Certificate</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer1.png" alt="" srcset="">
                                            <p class="mx-0">ยังไม่ผ่านเงื่อนไข</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="mb-0">แบบประเมินหลักสูตร</p>
                                        <div class="wrap-course-clild">
                                            <img src="assets/images/cer2.png" alt="" srcset="">
                                            <p class="mx-0">ทำแบบประเมิน</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="course-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab2" role="tablist">
                                        <button class="nav-link active" id="course-detail" data-bs-toggle="tab" data-bs-target="#nav12" type="button" role="tab" aria-controls="nav12" aria-selected="true">รายละเอียดหลักสูตร</button>
                                        <button class="nav-link" id="course-list" data-bs-toggle="tab" data-bs-target="#nav13" type="button" role="tab" aria-controls="nav13" aria-selected="false" tabindex="-1">รายการหลักสูตร</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="nav12" role="tabpanel" aria-labelledby="course-detail">
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                        <br>
                                        <br>
                                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                    </div>

                                    <div class="tab-pane fade" id="nav13" role="tabpanel" aria-labelledby="course-list">
                                        <div class="course-list">
                                            <div class="list-top">
                                                <div>
                                                    <span>บทที่ 1</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary d-flex"><img width="24px" class="mx-1" src="assets/images/download-doc.png" alt="" srcset="">เอกสารประกอบการเรียน</button>
                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-true.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <p>คะแนนที่ได้</p>
                                                    <div class="score-list">
                                                        <p>8/15</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-haft.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 1</p>
                                                </div>

                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-course">

                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <div class="link-btn">
                                                        <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 2</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 2</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 3</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 4</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>


                                            <div class="list-second">
                                                <div>
                                                    <span>บทที่ 4</span>
                                                    <span>ชื่อบทเรียน</span>
                                                </div>
                                                <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบก่อนเรียน</p>
                                                </div>

                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>วิดีโอบทที่ 4</p>
                                                </div>
                                                <div class="group2">
                                                    <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                                    <p>30 นาที</p>
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                            <div class="list-course">
                                                <div class="group1">
                                                    <img src="assets/images/check-lean.svg" alt="" srcset="">
                                                    <p>ทำข้อสอบหลังเรียน</p>
                                                </div>
                                                <div class="group2">
                                                    <img src="assets/images/keylog.svg" alt="" srcset="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>



                    </div>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card-main mb-3">
                        <img class="w-100" src="assets/images/course2.png" alt="" srcset="">
                        <div class="card-body">
                            <progress class="progressbar-inp" value="70" max="100"> 70% </progress>
                            <h5 class="card-title">85% กำลังเรียน</h5>
                            <div class="admin-course">

                                <table>
                                    <tbody>
                                        <tr>
                                            <td>เจ้าของหลักสูตร :</td>
                                            <td>คุณทวี เสริมศิล</td>
                                        </tr>
                                        <tr>
                                            <td>ผู้อนุมัติหลักสูตร :</td>
                                            <td>คุณวิรัช กิจเตชะการ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-main mb-5">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="mb-0">สถานะ Certificate</p>
                                <div class="wrap-course-clild">
                                    <img src="assets/images/cer1.png" alt="" srcset="">
                                    <p class="mx-0">ยังไม่ผ่านเงื่อนไข</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <p class="mb-0">แบบประเมินหลักสูตร</p>
                                <div class="wrap-course-clild">
                                    <img src="assets/images/cer2.png" alt="" srcset="">
                                    <p class="mx-0">ทำแบบประเมิน</p>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="period-day">
                        <p>Period 170 Day (14 / jul / 2022 - 31 Dec / 2026)</p>
                    </div>

                    <div class="course-tab">
                        <nav>
                            <div class="nav nav-tabs" id="tabcourse" role="tablist">
                                <button class="nav-link active" id="course-detail" data-bs-toggle="tab" data-bs-target="#nav1" type="button" role="tab" aria-controls="nav1" aria-selected="true">รายละเอียดหลักสูตร</button>
                                <button class="nav-link" id="course-list" data-bs-toggle="tab" data-bs-target="#nav2" type="button" role="tab" aria-controls="nav2" aria-selected="false" tabindex="-1">รายการหลักสูตร</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav1" role="tabpanel" aria-labelledby="course-detail">
                                Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                                <br>
                                <br>
                                Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                            </div>

                            <div class="tab-pane fade" id="nav2" role="tabpanel" aria-labelledby="course-list">
                                <div class="course-list">
                                    <div class="list-top">
                                        <div>
                                            <span>บทที่ 1</span>
                                            <span>ชื่อบทเรียน</span>
                                        </div>
                                        <button type="button" class="btn btn-secondary d-flex"><img width="24px" class="mx-1" src="assets/images/download-doc.png" alt="" srcset="">เอกสารประกอบการเรียน</button>
                                    </div>

                                    <div class="list-course">

                                        <div class="group1">
                                            <img src="assets/images/check-true.svg" alt="" srcset="">
                                            <p>ทำข้อสอบก่อนเรียน</p>
                                        </div>

                                        <div class="group2">
                                            <p>คะแนนที่ได้</p>
                                            <div class="score-list">
                                                <p>8/15</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="list-course">

                                        <div class="group1">
                                            <img src="assets/images/check-haft.svg" alt="" srcset="">
                                            <p>วิดีโอบทที่ 1</p>
                                        </div>

                                        <div class="group2">
                                            <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                            <p>30 นาที</p>
                                            <div class="link-btn">
                                                <button type="button" class="btn btn-link"><a href="index.php">ดูวิดีโอ</a></button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="list-course">

                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>ทำข้อสอบหลังเรียน</p>
                                        </div>

                                        <div class="group2">
                                            <div class="link-btn">
                                                <button type="button" class="btn btn-link"><a href="index.php">ทำข้อสอบ</a></button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="list-second">
                                        <div>
                                            <span>บทที่ 2</span>
                                            <span>ชื่อบทเรียน</span>
                                        </div>
                                        <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>ทำข้อสอบก่อนเรียน</p>
                                        </div>

                                        <div class="group2">
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>วิดีโอบทที่ 2</p>
                                        </div>
                                        <div class="group2">
                                            <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                            <p>30 นาที</p>
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>ทำข้อสอบหลังเรียน</p>
                                        </div>
                                        <div class="group2">
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="list-second">
                                        <div>
                                            <span>บทที่ 3</span>
                                            <span>ชื่อบทเรียน</span>
                                        </div>
                                        <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>ทำข้อสอบก่อนเรียน</p>
                                        </div>

                                        <div class="group2">
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>วิดีโอบทที่ 4</p>
                                        </div>
                                        <div class="group2">
                                            <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                            <p>30 นาที</p>
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>ทำข้อสอบหลังเรียน</p>
                                        </div>
                                        <div class="group2">
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>


                                    <div class="list-second">
                                        <div>
                                            <span>บทที่ 4</span>
                                            <span>ชื่อบทเรียน</span>
                                        </div>
                                        <button type="button" class="btn btn-secondary bg-white d-flex">ไม่มีเอกสารประกอบ</button>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>ทำข้อสอบก่อนเรียน</p>
                                        </div>

                                        <div class="group2">
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>วิดีโอบทที่ 4</p>
                                        </div>
                                        <div class="group2">
                                            <img style="width: 20px; height: 20px;" src="assets/images/clock.png" alt="" srcset="">
                                            <p>30 นาที</p>
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="list-course">
                                        <div class="group1">
                                            <img src="assets/images/check-lean.svg" alt="" srcset="">
                                            <p>ทำข้อสอบหลังเรียน</p>
                                        </div>
                                        <div class="group2">
                                            <img src="assets/images/keylog.svg" alt="" srcset="">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </div>







</main>



</main>

<script>
    // Optional: animation เล็กๆ ตอน scroll
    const items = document.querySelectorAll(".timeline-item");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, {
        threshold: 0.3
    });
</script>

<script>
    const text = document.getElementById("titleText");

    document.getElementById("btn1").addEventListener("click", function() {
        text.innerHTML = "การผลิต บรรจุภัณฑ์พลาสติก <br> ผลิตภัณฑ์เครื่องดื่ม การวิจัยและพัฒนา";

    });

    document.getElementById("btn2").addEventListener("click", function() {
        text.innerHTML = "ผลิตภัณฑ์เครื่องดื่ม การวิจัยและพัฒนา";
    });
</script>

<?php include 'includes/footer.php'; ?>