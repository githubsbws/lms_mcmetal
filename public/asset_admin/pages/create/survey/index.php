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
                    <h4 class="m-0">เพิ่มแบบสอบถาม</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เพิ่มแบบสอบถาม
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="namePupUp">หัวข้อเเบบสอบถาม <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" required>
                                    </div>
                                    <div class="form-group ">
                                        <label for="summernote">รายละเอียดเเบบสอบถาม</label>
                                        <textarea id="summernote"></textarea>
                                    </div>
                                    <div class="form-group  ">
                                        <button type="button" class="btn btn-success mt-3"><i class="fas fa-save mr-1"></i>เพิ่มกลุ่ม</button>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row  mt-4">
                                            <label class="col-2 mt-2"> ชื่อกลุ่ม </label>
                                            <input type="text" class="form-control col-4" id="namePupUp" value="" required>
                                        </div>
                                        <button type="button" class="btn btn-success mt-3">เพิ่มคำถามเเบบตอบบรรทัดเดียว</button>
                                        <button type="button" class="btn btn-success mt-3">เพิ่มคำถามเเบบคำตอบเดียว</button>
                                        <button type="button" class="btn btn-success mt-3">เพิ่มคำถามเเบบหลายคำตอบ</button>
                                        <button type="button" class="btn btn-success mt-3">เพิ่มคำถามเเบบให้คะเเนน</button>
                                        <button type="button" class="btn btn-success mt-3">เพิ่มคำถามบรรยาย</button>
                                        <button type="button" class="btn btn-danger mt-3">ลบ</button>

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary "><i class="fas fa-save mr-1"></i>บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>


    <script>
        $(document).ready(function() {
            // Summernote
            $('#summernote').summernote({
                placeholder: '',
                height: 150
            })
        })
    </script>
</body>

</html>