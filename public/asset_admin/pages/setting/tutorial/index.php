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
                    <h4 class="m-0">จัดการวิธีการใช้งาน</h4>
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
                                        <th style="width: 70%;">หัวข้อวิธีการใช้งาน ภาษาอังฤษ </th>
                                        <th>ย้าย</th>
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
                                        <td>1. Log on & Forgot password </td>
                                        <td>
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '> </i>
                                            </button>

                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข EN
                                            </a>

                                            <a href="./th/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข TH
                                            </a>
                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
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
                                        <td>2. Course</td>
                                        <td>
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>

                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข EN
                                            </a>

                                            <a href="./th/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข TH
                                            </a>
                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
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
                                        <td>3. How to use</td>
                                        <td>
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>

                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข EN
                                            </a>

                                            <a href="./th/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข TH
                                            </a>
                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
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
                                        <td>4. Frequently Asked Questions</td>
                                        <td>
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>

                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข EN
                                            </a>

                                            <a href="./th/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                แก้ไข TH
                                            </a>
                                        </td>
                                        <td>
                                            <a href="./en/index.php" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                        </td>
                                    </tr>
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