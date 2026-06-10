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
                    <h4 class="m-0">แก้ไขข้อสอบ</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการแก้ไข</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card border">
                        <div class="card-body">
                            <div class="section mb-3">
                                <p class="font-weight-bold mb-2">โจทย์</p>
                                <textarea class="summernote"></textarea>
                            </div>
                            <div class="section">
                                <p class="font-weight-bold mb-2">คำอธิบาย</p>
                                <textarea class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'กรอกข้อมูลที่ต้องการ',
                height: 100
            });
        });
    </script>
</body>
</html>