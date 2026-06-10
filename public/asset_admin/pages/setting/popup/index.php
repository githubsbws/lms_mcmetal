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
                    <h4 class="m-0">จัดการเงื่อนไขการใช้งาน</h4>
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
                                        <th>รูปภาพ</th>
                                        <th>ชื่อป๊อปอัพภาษาอังกฤษ</th>
                                        <th>ลิ้งค์ภาษาอังกฤษ</th>
                                        <th>วัน-เวลาแก้ไขข้อมูล</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>รูป</td>
                                        <td>Test by SDD</td>
                                        <td>NaN</td>
                                        <td>2022-03-27 23:53:06</td>
                                        <td>
                                            <span class="status-badge status-active"><i class="fas fa-dot-circle"></i> แสดง</span>
                                        </td>
                                        <td>
                                            <a href="">
                                                <button class="btn btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                    แก้ไข EN
                                                </button>
                                            </a>
                                            <a href="">
                                                <button class="btn btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                    แก้ไข TH
                                                </button>
                                            </a>
                                            <button class="btn btn-danger">
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