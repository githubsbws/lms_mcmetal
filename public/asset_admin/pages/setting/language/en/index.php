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
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">จัดการภาษาอังกฤษ</h4>
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
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    จัดการภาษาอังกฤษ
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText">ภาษา</label>
                                        <input type="text" class="form-control" id="inputText" value="EN" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFile">รูปภาพ</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputFile">
                                            <label class="custom-file-label" for="inputFile">เลือกไฟล์ที่ต้องการ</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="inputFile">สภานะ</label>
                                        <div>
                                            <input type="checkbox" data-toggle="toggle" data-on="แสดง" data-off="ไม่แสดง" data-onstyle="success" data-offstyle="danger"/>
                                        </div>
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
            </div>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>

    </div>
</body>
</html>