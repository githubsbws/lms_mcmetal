@extends('layout/mainlayout')
@section('title', 'Brother e-learning')
@section('content')
@php
use App\Models\Downloadcategoty;
use App\Models\DownloadFile;

@endphp

<style>
    /* --- Pure CSS Custom Reset & Typography --- */
    p {
        margin-bottom: 0;
    }

    a,
    a:hover,
    a:focus {
        color: #000000;
        text-decoration: none !important;
        outline: none !important;
    }

    /* --- Content Layout --- */
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

 /*    .brand-logo {
        width: 65px;
        height: auto;
        display: block;
    }

    .brand-logo {
        height: 50px;
    } */
</style>


<body>

    <div class="main-content">
        <div class="page-sidebar-title">
            <span>คำถามที่พบบ่อย</span>
        </div>

        <div class="container-fluid">

            <h2 class="page-main-title">คำถามที่พบบ่อย</h2>

            <div class="custom-accordion-container">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    1. การเรียน/สอบ ผ่านระบบ E-Learning
                                    <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="faq-text-block">
                                    1. "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat." </div>
                                <div class="faq-text-block">
                                    2. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero. </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    2. ลืมรหัสผ่าน
                                    <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    3. วิธีแจ้งปัญหาการใช้งาน
                                    <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    4. สามารถใช้งานภาษาอะไรได้บ้าง
                                    <i class="fa-solid fa-chevron-down chevron-icon"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                            <div class="panel-body">
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."

                            </div>
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