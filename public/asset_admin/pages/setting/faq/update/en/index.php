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
                    <h4 class="m-0"> แก้ไขคำถามที่พบบ่อย</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    แก้ไขคำถามที่พบบ่อย
                                </div>
                                <div class="card-body">
                                    <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>
                                    <div class="form-group">
                                        <label for="namePupUp">หมวดคำถาม <span class="text-danger"> * </span></label>
                                        <select class="form-control" id="division">
                                            <option selected> เลือก หมวดคำถาม</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="detailPopUp">คำถาม ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="division" value="" required>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="summernote">คำตอบ ภาษาอังกฤษ</label>
                                        <textarea id="summernote"></textarea>
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