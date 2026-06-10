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
                    <h4 class="m-0">เพิ่มหมวดหลักสูตร สำหรับภาษาไทย</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เพิ่มหมวดหลักสูตร
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="typeCategory">ประเภทหลักสูตร</label>
                                        <select class="form-control" id="typeCategory">
                                            <option>Specific Course</option>
                                            <option>General Course</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">ชื่อหมวดหลักสูตร (ภาษาไทย)</label>
                                        <input type="text" class="form-control" id="inputText" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="detailCategory">รายละเอียดหมวดหลักสูตร (ภาษาไทย)</label>
                                        <textarea class="form-control" id="detailCategory" rows="4"></textarea>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="inputFile">รูปภาพ</label>
                                        <div class="custom-file mb-1">
                                            <input type="file" class="custom-file-input" id="inputFile">
                                            <label class="custom-file-label" for="inputFile">เลือกไฟล์ที่ต้องการ</label>
                                        </div>
                                        <p class="text-danger">* รูปภาพควรมีขนาด 250x180(แนวนอน) หรือ ขนาด 250x(xxx) (แนวยาว)</p>
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