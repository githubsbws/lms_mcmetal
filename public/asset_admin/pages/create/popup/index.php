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
                            <h4 class="m-0">เพิ่มป๊อปอัพสำหรับภาษาอังกฤษ</h4>
                            <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                        </div>
                        <div class="ml-3">
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
                                    เพิ่มป๊อปอัพสำหรับภาษาอังกฤษ
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="namePupUp">ชื่อป๊อปอัพ ภาษาอังกฤษ</label>
                                        <input type="text" class="form-control" id="namePupUp" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="detailPopUp">รายละเอียดย่อ ภาษาอังกฤษ</label>
                                        <textarea class="form-control" id="detailPopUp" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="col px-0 mr-3">
                                            <label for="startDate">วันเริ่มต้น</label>
                                            <input type="date" class="form-control" id="startDate" value="" required>
                                        </div>
                                        <div class="col px-0">
                                            <label for="endDate">วันสิ้นสุด</label>
                                            <input type="date" class="form-control" id="endDate" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">ลิ้งค์</label>
                                        <input type="text" class="form-control" id="link" value="" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <p class="mb-1 font-weight-bold">รูปภาพ ภาษาอังกฤษ</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="images">
                                            <label class="custom-file-label" for="images">เลือกไฟล์</label>
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