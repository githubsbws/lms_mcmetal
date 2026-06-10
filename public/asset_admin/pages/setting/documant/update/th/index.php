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
                    <h4 class="m-0">แก้ไขเอกสาร</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    แก้ไขเอกสารสำหรับภาษาไทย
                                </div>
                                <div class="card-body">
                                <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>
                                    <div class="form-group">
                                        <label for="inputText">รหัสประเภทของไฟล์ ภาษาไทย</label>
                                        <select class="form-control" id="typeCategory">
                                            <option>ทั้งหมด</option>
                                            <option>General knowledge</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">ชื่อของไฟล์ดาวน์โหลด ภาษาไทย</label>
                                        <input type="text" class="form-control" id="inputText" value="" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="inputText">รายระเอียดไฟล์ดาวน์โหลด ภาษาไทย</label>
                                        <textarea id="summernote"></textarea>
                                    </div>


                                    <div class="form-group mb-0">
                                        <p class="mb-1 font-weight-bold">ตำแหน่งที่ตั้งไฟล์ ภาษาไทย</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file">
                                            <label class="custom-file-label" for="file"></label>
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