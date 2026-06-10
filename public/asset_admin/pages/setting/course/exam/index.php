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
                    <h4 class="m-0">จัดการชุดข้อสอบหลักสูตร</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card p-3 border">
                        <table id="langTable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ชื่อหลักสูตร</th>
                                    <th>ชื่อชุด</th>
                                    <th>จำนวนข้อ</th>
                                    <th colspan="2">ไฟล์ Exel</th>
                                    <th colspan="2">ข้อสอบ</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ทดสอบ</td>
                                    <td>ทดสอบ</td>
                                    <td>5</td>
                                    <td>
                                        <a href="import">
                                            <button class="btn btn-success btn-block btn-sm">
                                                Import Exel
                                            </button>
                                        </a>
                                        
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-block btn-sm">
                                            Export Exel
                                        </button>
                                    </td>
                                    <td>
                                        <a href="/Demo-LMS-New/admin/pages/create/course/exam/id/">
                                            <button class="btn btn-secondary btn-block btn-sm">
                                                เพิ่มข้อสอบ
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="id/question/">
                                            <button class="btn btn-secondary btn-block btn-sm">
                                                จัดการข้อสอบ
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="id">
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

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
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
</body>
</html>