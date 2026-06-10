<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid d-flex align-items-center">
                    <div class="">
                        <h4 class="m-0">เลือกชุดข้อสอบสำหรับการทดสอบก่อนเรียน</h4>
                        <p class="m-0 text-black-50">เลือกชุดข้อสอบที่ต้องการ</p>
                    </div>
                    <div class="ml-3">
                        <a href="../">
                            <button class="btn btn-warning d-flex align-items-center">
                                <i class="fas fa-angle-left mr-2"></i>
                                กลับหน้าจัดการ
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-sm-2">
                        <div class="col mx-auto">
                            <div class="card m-0 h-full">
                                <div class="card-header bg-primary">
                                    เลือกชุดข้อสอบ
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="typePosttest">ชุดข้อสอบ</label>
                                        <select class="form-control" id="typePosttest">
                                            <option disabled selected>เลือกชุดข้อสอบ</option>
                                            <option>General Course</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="count">จำนวนข้อในการแสดง</label>
                                        <input type="number" class="form-control" id="count" value="0" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                                </div>
                            </div>
                        </div>
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    รายละเอียดชุดข้อสอบที่เลือก
                                </div>
                                <div class="card-body">
                                    <p class="text-center mb-0 text-muted">ไม่พบข้อสอบที่ต้องการ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
</body>
</html>