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
                    <h4 class="m-0">จัดการหลักสูตร</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card m-0">
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>รูปภาพ</th>
                                        <th>หมวดอบรมออนไลน์</th>
                                        <th>ชื่อหลักสูตรอบรมออนไลน์ (EN)</th>
                                        <th>รุ่น</th>
                                        <th>จัดเรียงบทเรียน</th>
                                        <th>ก่อนเรียน</th>
                                        <th>หลังเรียน</th>
                                        <th>แบบประเมิน</th>
                                        <th>ย้าย</th>
                                        <th>เปิด/ปิด การแสดงผล</th>
                                        <th>ภาษา</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-center"> รูป </td>
                                        <td>หลักสูตรอบรมตามความจำเป็นสำหรับพนักงาน/Manded by IMCT</td>
                                        <td>Basic Grammar of Japanese Language</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm btn-block">
                                                จัดการรุ่น (0)
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm btn-block">
                                                จัดเรียงบท (1)
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm btn-block">
                                                เลือกข้อสอบ (1)
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm btn-block">
                                                เลือกข้อสอบ (1)
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm btn-block">
                                                เพิ่มแบบประเมิน (1)
                                            </a>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-dark btn-sm">
                                                    <i class='fas fa-arrows-alt '></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <a href="#" class="btn btn-success btn-sm">
                                                    เปิด
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="./update/en/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                EN (เเก้ไข)
                                            </a>

                                            <a href="./update/th/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                TH (เเก้ไข)
                                            </a>

                                        </td>
                                        <td>
                                            <a href="./view/" class="btn btn-danger btn-sm">
                                                <i class="fas fa-address-card"></i>
                                            </a>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            <button class="btn btn-danger my-4 mx-2 btn-sm"> ลบข้อมูลทั้งหมด </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>

        <script>
            $(document).ready(function() {
                $('#settingTable').DataTable({
                    scrollX: true,
                    language: {
                        url: '/includes/languageDataTable.json',
                    }
                });
            });
        </script>
    </div>
</body>

</html>