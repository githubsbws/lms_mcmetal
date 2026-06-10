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
                            <h4 class="m-0">เพิ่มเมนูสำหรับภาษาอังกฤษ</h4>
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
                                    เพิ่มเมนูสำหรับภาษาอังกฤษ
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText">ชื่อเมนูภาษาอังกฤษ</label>
                                        <input type="text" class="form-control" id="inputText" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">URL ภาษาอังกฤษ</label>
                                        <input type="text" class="form-control" id="inputText" value="" required>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="inputFile">แสดงผล (ภาษา US)</label>
                                        <div class="button-group d-flex">
                                            <div class="col">
                                                <input class="radioButton enable" type="radio" id="enable" value="enable" name="status" checked/>
                                                <label for="enable" class="d-flex align-items-center">
                                                    <i class="fas fa-eye mr-1"></i>
                                                    แสดง
                                                </label>
                                            </div>
                                            <div class="col">
                                                <input class="radioButton disable" type="radio" id="disable" value="disable" name="status"/>
                                                <label for="disable" class="d-flex align-items-center">
                                                    <i class="fas fa-eye-slash mr-1"></i>
                                                    ไม่แสดง
                                                </label>
                                            </div>
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