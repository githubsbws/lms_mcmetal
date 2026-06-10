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
                    <h4 class="m-0">จัดการวิดีโอ</h4>
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
                                        <th>หมวดหมู่</th>
                                        <th>หัวข้อวิดีโอ ภาษาอังกฤษ</th>
                                        <th>ชื่อไฟล์วิดีโอ ภาษาอังกฤษ</th>
                                        <th>ภาษา</th>
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
                                        <td class="text-center">วิดีโอ</td>
                                        <td>test E-learning</td>
                                        <td>test E-learningVIDEO.mp4</td>
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
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="./update/en/" class="btn btn-warning btn-sm">
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
                                        <td class="text-center">วิดีโอ</td>
                                        <td>fffff</td>
                                        <td>040102546.mp4 </td>
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
                                            <button class="btn btn-dark btn-sm">
                                                <i class='fas fa-arrows-alt '></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="./update/en/" class="btn btn-warning btn-sm">
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