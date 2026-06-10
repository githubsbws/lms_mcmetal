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
                    <h4 class="m-0">แก้ไขประเภทห้องสมุด</h4>
                    <p class="m-0 text-black-50">แก้ไขข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    แก้ไขประเภทห้องสมุด
                                </div>
                                <div class="card-body">
                                    <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>

                                    <div class="form-group">
                                        <label for="namePupUp">ประเภท ภาษาไทย <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="namePupUp">ประเภท ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="namePupUp"> หมวดหมู่ <span class="text-danger"> * </span></label>
                                        <div class="row mx-1">
                                            <div class="form-check col-2">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label " for="flexRadioDefault1">
                                                    Media
                                                </label>
                                            </div>

                                            <div class="form-check col-2 ">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Document
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="namePupUp">นามสกุลไฟล์ </label>
                                        <input type="text" class="form-control" id="namePupUp" value="" required>
                                        <p class="mt-4"><span class="text-danger"> * (คั่นด้วย comma , ) [ mp4, mkv, mp3, pdf, doc, docx, xls, xlsx, ppt, pptx ] </span></p>
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
</body>

</html>