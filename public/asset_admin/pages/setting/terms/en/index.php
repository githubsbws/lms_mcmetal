<!DOCTYPE html>
<html lang="en">

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';
?>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">จัดการเงื่อนไขการใช้งานภาษาอังกฤษ</h4>
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
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header bg-primary">
                            จัดการเงื่อนไขการใช้งานภาษาไทย
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputText">หัวข้อเงื่อนไขการใช้งาน</label>
                                <input type="text" class="form-control" id="inputText" value="" required>
                            </div>
                            <div class="form-group mb-0">
                                <label for="summernote">รายละเอียดเงื่อนไขการใช้งาน</label>
                                <textarea id="summernote"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                            <button type="button" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>ลบ</button>
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
                placeholder: 'กรอกข้อมูลที่ต้องการแก้ไข',
                height: 150
            })
        })
    </script>
</body>
</html>