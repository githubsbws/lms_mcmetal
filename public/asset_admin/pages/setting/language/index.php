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
                    <h4 class="m-0">จัดการภาษา</h4>
                    <p class="m-0 text-black-50">เลือกภาษาที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card p-3 border">
                        <table id="langTable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="w-75">ภาษา</th>
                                    <th>สถานะ</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TH</td>
                                    <td>
                                        <span class="status-badge status-active"><i class="fas fa-dot-circle"></i> แสดง</span>
                                    </td>
                                    <td>
                                        <a href="th">
                                            <button class="btn btn-warning">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </a>
                                        <button class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>EN</td>
                                    <td>
                                        <span class="status-badge"><i class="fas fa-dot-circle"></i> ไม่แสดง</span>
                                    </td>
                                    <td>
                                        <a href="en">
                                            <button class="btn btn-warning">
                                                <i class="fas fa-pen"></i>
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

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>

    </div>
</body>
<script>
    $(document).ready(function() {
        $('#langTable').DataTable({
            responsive: true,
            language: {
                url: '/includes/languageDataTable.json',
            }
        });
    });
</script>
</html>