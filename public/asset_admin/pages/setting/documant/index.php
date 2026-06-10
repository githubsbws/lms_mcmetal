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
                    <h4 class="m-0">จัดการเอกสาร</h4>
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
                                        <th>หมวดเอกสาร</th>
                                        <th>ไฟล์</th>
                                        <th>ชื่อ</th>
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
                                        <td class="w-25">Introduclion start</td>
                                        <td></td>
                                        <td>ทดสอบ</td>
                                        <td>
                                            <div class="container text-center">
                                                <a href="./update/en/" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i>
                                                    EN (เเก้ไข)
                                                </a>

                                                <a href="./update/th/" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i>
                                                    TH (เเก้ไข)
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="./view/" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="./update/en/">
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
                <div class="row">
                    <div class="col d-flex justify-content-start ">
                        <button class="btn btn-danger my-4 mx-2 btn-sm"> ลบข้อมูลทั้งหมด </button>
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