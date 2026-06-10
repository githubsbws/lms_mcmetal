<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h4 class="m-0">เพิ่มคลังข้อสอบออนไลน์</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-3">
                        <div class="col mx-auto mb-3 md-mb-0">
                            <div class="card m-0 h-full sticky-top">
                                <div class="card-header bg-primary">
                                    สร้างคำถาม
                                </div>
                                <div class="card-body">
                                    <div class="section mb-4">
                                        <p class="mb-0 text-muted">จำนวนข้อที่สร้าง</p>
                                        <h4 class="mb-0"><span id="targetCount">0</span> ข้อ</h4>
                                    </div>
                                    <button class="btn btn-success btn-block" onclick="setupQuestion('multipleChoiceOneAnswer');">
                                        เพิ่มข้อสอบคำตอบเดียว
                                    </button>
                                    <button class="btn btn-success btn-block" onclick="setupQuestion('mutipleChoiceMultipleAnser')">
                                        เพิ่มข้อสอบหลายคำตอบ
                                    </button>
                                    <button class="btn btn-success btn-block" onclick="setupQuestion('describe')">
                                        เพิ่มข้อสอบบรรยาย
                                    </button>
                                    <button class="btn btn-success btn-block" onclick="setupQuestion('matching')">
                                        เพิ่มข้อสอบจับคู่
                                    </button>
                                    <button class="btn btn-success btn-block" onclick="setupQuestion('ordering')">
                                        เพิ่มข้อสอบจัดเรียง
                                    </button>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                                </div>
                            </div>
                        </div>
                        <div class="col mx-auto col-md-8" id="targetShow">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
    <script src="/Demo-LMS-New/admin/includes/js/createExamV2.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'กรอกข้อมูลที่ต้องการ',
                height: 100
            });
        });
    </script>
</body>
</html>