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
                    <h4 class="m-0">จัดการแบบสอบถาม</h4>
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
                                        <th>ชื่อเเบบสอบถาม </th>
                                        <th>link ทำเเบบสอบถาม</th>
                                        <th>รายงาน</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="w-75">For test</td>
                                        <td class="w-25">
                                            <input type="text" class="form-control" id=" copylink" value="http://localhost/Demo-LMS-New/admin/index.php" required>
                                            <div class="container text-center">
                                                <a class="btn btn-primary btn-sm mt-2 ">
                                                    Copy link
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm">
                                                รายงาน
                                            </a>
                                        </td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-75">ทดสอบเเบบสอบถาม</td>
                                        <td class="w-25">
                                            <input type="text" class="form-control" id=" copylink" value="http://localhost/Demo-LMS-New/admin/index.php" required>
                                            <div class="container text-center">
                                                <a class="btn btn-primary btn-sm mt-2 ">
                                                    Copy link
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm">
                                                รายงาน
                                            </a>
                                        </td>
                                        <td>
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
                <div class="col d-flex justify-content-start">
                    <button class="btn btn-danger my-4 mx-2 btn-sm"> ลบข้อมูลทั้งหมด </button>
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