<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid d-flex align-items-center">
                    <div class="">
                        <h4 class="m-0">จัดการห้องสมุด</h4>
                        <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                    </div>
                    <div class="ml-3">
                        <a href="/Demo-LMS-New/admin/pages/create/library/">
                            <button class="btn btn-warning px-2 d-flex align-items-center">
                                <i class="fas fa-plus-circle pr-1"></i> เพิ่มห้องสมุด
                            </button>
                        </a>
                    </div>
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
                                        <th>ประเภท</th>
                                        <th style="width: 80%;">ชื่อไฟล์</th>
                                        <th>ย้าย</th>
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
                                        <td class="w-25">รูป</td>
                                        <td>English Language</td>
                                        <td class="w-100"> Financial knowledge for your stability future </td>
                                        <td>
                                            <button class="btn btn-dark btn-sm ">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="./view/" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
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
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                </label>
                                            </div>
                                        </td>
                                        <td class="w-25">รูป</td>
                                        <td>Library Mannal</td>
                                        <td class="w-100"> Basic English Grammar </td>
                                        <td>
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="./view/" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
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
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                </label>
                                            </div>
                                        </td>
                                        <td>รูป</td>
                                        <td>Financial and investment</td>
                                        <td class="w-100">Happy Money for Salary Man </td>
                                        <td>
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="./view/" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
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
                <button class="btn btn-danger my-4 mx-2 btn-sm"> ลบข้อมูลทั้งหมด </button>
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