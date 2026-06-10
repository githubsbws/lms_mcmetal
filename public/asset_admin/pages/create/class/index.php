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
                    <h4 class="m-0"> เพิ่ม Employee Class</h4>
                    <p class="m-0 text-black-50"> เพิ่มข้อมูลที่ต้องการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เพิ่ม Employee Class
                                </div>
                                <div class="card-body">
                                    <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>
                                    <div class="form-group">
                                        <label for="employee">ชื่อ Employee Class <span class="text-danger"> * </span> </label>
                                        <input type="text" class="form-control" id="employee" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">คำอธิบาย <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="description" value="" required>
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