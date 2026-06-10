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
                    <h4 class="m-0">จัดการสมาชิก</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card m-0">
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับที่</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>รหัสพนักงาน</th>
                                        <th>ลำดับชั้นงาน</th>
                                        <th>ตำแหน่งงาน</th>
                                        <th>อีเมล</th>
                                        <th>วันที่สร้าง</th>
                                        <th>เข้ามาล่าสุด</th>
                                        <th>สถานะ</th>
                                        <th>Online Status</th>
                                        <th>เปลี่ยนรหัสผ่าน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>sdfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                    </tr>

                                    <tr>
                                        <td>sdfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                    </tr>

                                    <tr>
                                        <td>sdfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                    </tr>

                                    <tr>
                                        <td>sdfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                    </tr>

                                    <tr>
                                        <td>sdfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                    </tr>

                                    <tr>
                                        <td>sdfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                        <td>sdfsdf</td>
                                        <td>dsfdsf</td>
                                        <td>dsfds</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
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