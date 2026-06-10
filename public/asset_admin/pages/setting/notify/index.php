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
                    <h4 class="m-0">จัดการแจ้งเตือนบทเรียน</h4>
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
                                        <th>หลักสูตร</th>
                                        <th>ระยะเวลาแจ้งเตือนก่อนสิ้นสุด (วัน)</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="w-50">สูตรแกงเขียวหวานไก่</td>
                                        <td class="w-25">7 วัน</td>
                                        <td>ปิดใช้งาน</td>
                                        <td>
                                            <a href="./update/view/" class="btn btn-danger btn-sm">
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

                                    <tr>
                                        <td>ไก่ทอดหาดใหญ่</td>
                                        <td>30 วัน</td>
                                        <td>เปิดใช้งาน</td>
                                        <td>
                                            <a href="./update/view/" class="btn btn-danger btn-sm">
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

                                    <tr>
                                        <td>น้ำปลาหวาน</td>
                                        <td>5 วัน</td>
                                        <td>เปิดใช้งาน</td>
                                        <td>
                                            <a href="./update/view/" class="btn btn-danger btn-sm">
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
                </div>
            </div>
        </div>
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
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
</body>

</html>