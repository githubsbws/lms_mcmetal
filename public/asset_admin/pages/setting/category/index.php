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
                    <h4 class="m-0">จัดการหมวดหลักสูตร</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card m-0">
                        <div class="card-body">
                            <span class="badge badge-danger mb-2">* หมายเหตุ ถ้าลบหมวดหลักสูตร จะทำให้หลักสูตร, บทเรียน(วิดีโอ), ข้อสอบ จะถูกลบไปด้วย</span>
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>รูปภาพ</th>
                                        <th>จัดการประเภทหลักสูตร</th>
                                        <th>ชื่อหมวดหลักสูตร (ภาษา US )</th>
                                        <th>การแสดงผล</th>
                                        <th>ภาษา</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>รูป</td>
                                        <td>Specific Course</td>
                                        <td>หลักสูตรเฉพาะ/Specific course</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-block btn-sm">ไม่แสดง</button>
                                        </td>
                                        <td>
                                            <a href="en">
                                                <button type="button" class="btn btn-success btn-sm">ภาษาอังกฤษ</button>
                                            </a>
                                            <a href="th">
                                                <button type="button" class="btn btn-success btn-sm">ภาษาไทย</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/Demo-LMS-New/admin/pages/setting/category/en/">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>รูป</td>
                                        <td>Specific Course</td>
                                        <td>หลักสูตรเฉพาะ/Specific course</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-block btn-sm">แสดง</button>
                                        </td>
                                        <td>
                                            <a href="en">
                                                <button type="button" class="btn btn-success btn-sm">ภาษาอังกฤษ</button>
                                            </a>
                                            <a href="/Demo-LMS-New/admin/pages/create/category/th/">
                                                <button type="button" class="btn btn-secondary btn-sm">ภาษาไทย (เพิ่ม)</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/Demo-LMS-New/admin/pages/setting/category/en/">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i>
                                                </button>
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
                </div>
            </div>

        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
    <script>
        $(document).ready(function() {
            $('#settingTable').DataTable({
                responsive: true,
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
            });
        });
    </script>
</body>
</html>