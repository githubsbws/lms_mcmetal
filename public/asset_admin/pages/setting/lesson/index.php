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
                    <h4 class="m-0">จัดการเนื้อหาบทเรียน</h4>
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
                                        <th>หลักสูตรอบรมออนไลน์</th>
                                        <th>ชื่อบทเรียน (ภาษาอังกฤษ)</th>
                                        <th>จัดการวิดีโอ</th>
                                        <th>ก่อนเรียน</th>
                                        <th>หลังเรียน</th>
                                        <th>ภาษา</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>
                                            <a href="vdo/">
                                                <button type="button" class="btn btn-primary btn-block btn-sm">
                                                    จัดการ VDO (0)
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="pretest/">
                                                <button type="button" class="btn btn-primary btn-block btn-sm">
                                                    เลือกข้อสอบ (0)
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="posttest/">
                                                <button type="button" class="btn btn-primary btn-block btn-sm">
                                                    เลือกข้อสอบ (0)
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="id/en/">
                                                <button type="button" class="btn btn-success btn-block btn-sm">
                                                    ภาษาอังกฤษ
                                                </button>
                                            </a>
                                            <a href="id/th/">
                                                <button type="button" class="btn btn-success btn-block btn-sm mt-1">
                                                    ภาษาไทย
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/Demo-LMS-New/admin/pages/setting/lesson/id/en/">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>
                                            <a href="vdo/">
                                                <button type="button" class="btn btn-primary btn-block btn-sm">
                                                    จัดการ VDO (0)
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="pretest/">
                                                <button type="button" class="btn btn-primary btn-block btn-sm">
                                                    เลือกข้อสอบ (0)
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="posttest/">
                                                <button type="button" class="btn btn-primary btn-block btn-sm">
                                                    เลือกข้อสอบ (0)
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="id/en/">
                                                <button type="button" class="btn btn-success btn-block btn-sm">
                                                    ภาษาอังกฤษ
                                                </button>
                                            </a>
                                            <a href="/Demo-LMS-New/admin/pages/create/lesson/th/">
                                                <button type="button" class="btn btn-secondary btn-block btn-sm mt-1">
                                                    ภาษาไทย (เพิ่มช้อมูล)
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/Demo-LMS-New/admin/pages/setting/lesson/id/en/">
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