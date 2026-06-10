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
                    <h4 class="m-0">เพิ่มคลังข้อสอบ</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-2">
                        <div class="col mx-auto mb-3 md-mb-0">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    คำและความหมาย
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered mb-3">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">ประเภทคำตอบ</th>
                                                <th scope="col">ความหมาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>radio</td>
                                                <td>ข้อสอบคำตอบเดียว</td>
                                            </tr>
                                            <tr>
                                                <td>checkbox</td>
                                                <td>ข้อสอบหลายคำตอบ</td>
                                            </tr>
                                            <tr>
                                                <td>textarea</td>
                                                <td>ข้อสอบบรรยาย</td>
                                            </tr>
                                            <tr>
                                                <td>dropdown</td>
                                                <td>ข้อสอบจับคู่</td>
                                            </tr>
                                            <tr>
                                                <td>hidden</td>
                                                <td>จัดเรียง</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="mb-0">การใส่สัญลักษณ์ <span class="text-danger">*หน้าตัวเลือก</span> หมายความว่า ตัวเลือกนั้นคือคำตอบที่ถูกต้อง</p>
                                </div>
                            </div>
                        </div>
                        <div class="col mx-auto">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    นำเข้าไฟล์ Excel
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <p class="mb-2 font-weight-bold">แบบฟอร์มรูปแบบนำเข้าแบบทดสอบ</p>
                                        <button class="btn btn-success btn-block">
                                            <i class="fas fa-download mr-1"></i>ดาวน์โหลด
                                        </button>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="inputFile">ไฟล์ Excel</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputFile">
                                            <label class="custom-file-label" for="inputFile">เลือกไฟล์ที่ต้องการ</label>
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
</body>
</html>