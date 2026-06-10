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
                    <h4 class="m-0">เพิ่มช่องทางการติดต่อ</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เพิ่มช่องทางการติดต่อ
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-3 w-100">
                                            <label for="firstNameTH">ชื่อ</label>
                                            <input type="text" class="form-control" id="firstNameTH" value="" required>
                                        </div>
                                        <div class="form-group px-0 w-100">
                                            <label for="lastNameTH">นามสกุล</label>
                                            <input type="text" class="form-control" id="lastNameTH" value="" required>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-3 w-100">
                                            <label for="firstNameEN">ชื่อ ภาษาอังกฤษ</label>
                                            <input type="text" class="form-control" id="firstNameEN" value="" required>
                                        </div>
                                        <div class="form-group px-0 w-100">
                                            <label for="lastNameEN">นามสกุล ภาษาอังกฤษ</label>
                                            <input type="text" class="form-control" id="lastNameEN" value="" required>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-3 w-100">
                                            <label for="positionTH">ตำแหน่ง</label>
                                            <input type="text" class="form-control" id="positionTH" value="" required>
                                        </div>
                                        <div class="form-group px-0 w-100">
                                            <label for="positionEN">ตำแหน่ง ภาษาอังกฤษ</label>
                                            <input type="text" class="form-control" id="positionEN" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group px-0 mr-3 w-100">
                                        <label for="telephone">เบอร์โทร</label>
                                        <input type="text" class="form-control" id="telephone" value="" required>
                                    </div>
                                    <div class="form-group px-0 mr-3 w-100">
                                        <label for="email">อีเมล</label>
                                        <input type="text" class="form-control" id="email" value="" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <p class="mb-1 font-weight-bold">รูปภาพ</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="images">
                                            <label class="custom-file-label" for="images">เลือกไฟล์</label>
                                        </div>
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