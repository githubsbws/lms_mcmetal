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
                    <h4 class="m-0">รายงานสถิติจำนวนผู้พิมพ์ใบประกาศ</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    ค้นหา
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="form-group px-0 w-100">
                                            <label>ชื่อหลักสูตร (บังคับ)</label>
                                            <div class="w-100">
                                                <select class="form-select form-control" aria-label="Default select example">
                                                    <option selected>ทั้งหมด</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group px-0 w-100">
                                            <label>รุ่น (บังคับ)</label>
                                            <div>
                                                <select class="form-select form-control" aria-label="Default select example">
                                                    <option selected>กรุณาเลือกหลักสูตร</option>
                                                    <option value="1">ไม่มีรุ่น</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group px-0 w-100">
                                            <label>ประเภทสมาชิก</label>
                                            <div class="w-100">
                                                <select class="form-select form-control" aria-label="Default select example">
                                                    <option selected>ทั้งหมด</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group px-0 w-100">
                                            <label>ฝ่าย</label>
                                            <div class="w-100">
                                                <select class="form-select form-control" aria-label="Default select example">
                                                    <option selected>ทั้งหมด</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group px-0 w-100">
                                            <label>เเผนก</label>
                                            <div class="w-100">
                                                <select class="form-select form-control" aria-label="Default select example">
                                                    <option selected>ทั้งหมด</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-1 w-100">
                                            <label for="lastNameEN">วันที่เริ่มต้น</label>
                                            <input type="text" class="form-control" id="lastNameEN" value="" required>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-1 w-100">
                                            <label for="positionTH">วันที่สิ้นสุด</label>
                                            <input type="text" class="form-control" id="positionTH" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary "><i class="fas fa-save mr-1"></i>ค้นหา</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header">
                <div class="container-fluid mt-3">
                    <div class="card m-0">
                        <div class="card-header">
                            <i class='fas fa-list-ul mr-1'></i>
                            สถิติจำนวนผู้พิมพ์หนังสือรับรอง : วันที่ ถึงวันที่
                        </div>
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>บทเรียน</th>
                                        <th>ผู้เรียนทั้งหมด</th>
                                        <th>เรียนผ่าน</th>
                                        <th>พิมพ์ใบประกาศ</th>
                                        <th>ไม่พิมพ์ใบประกาศ</th>
                                        <th>คิดเป็นร้อยละ</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="w-50">Review : IMCT Compliance E-Learning 23 - 30 April 2024</td>
                                        <td>46</td>
                                        <td>43</td>
                                        <td>0</td>
                                        <td>43</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th class="w-50"> รวมทั้งสิ้น</th>
                                        <td>46</td>
                                        <td>43</td>
                                        <td>0</td>
                                        <td>43</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="">
                                <button class="btn btn-danger">
                                    <i class="fas fa-file-export mr-1" style="color: #ffa8a8;"></i>
                                    Export Excel
                                </button>
                            </a>
                        </div>
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