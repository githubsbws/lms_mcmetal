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
                    <h4 class="m-0">จัดการชุดข้อสอบ</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    จัดการชุดข้อสอบ
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="className">ชื่อบทเรียนออนไลน์</label>
                                        <select class="form-control" id="className">
                                            <option value="" disabled selected>-- กรุณาเลือกบทเรียน --</option>
                                            <option value="">ชื่อบทเรียน</option>
                                            <option value="">ชื่อบทเรียน</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="groupName">ชื่อชุด</label>
                                        <input type="text" class="form-control" id="groupName" value="" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
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