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
                    <h4 class="m-0">เพิ่มวิธีการใช้งาน</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เพิ่มวิธีการใช้งาน
                                </div>
                                <div class="card-body">
                                    <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>
                                    <div class="form-group">
                                        <label for="namePupUp">หัวข้อวิธีการใช้งาน ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" required>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="summernote">รายละเอียดการใช้งาน ภาษาอังกฤษ</label>
                                        <textarea id="summernote"></textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <p class="mb-1 font-weight-bold">รูปภาพหน้าปก</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="images">
                                            <label class="custom-file-label" for="images">เลือกรูป</label>
                                            <p class="mt-4"><span class="text-danger"> * รูปภาพควรมีขนาด 255x150px(เเนวนอน) หรือ ขนาด 255x(xxx)px (เเนวยาว) </span></p>
                                        </div>
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