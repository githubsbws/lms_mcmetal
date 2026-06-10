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
                    <h4 class="m-0">จัดการอนุมัติหลักสูตร เฉพาะ</h4>
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
                                        <th>หมวดอบรมออนไลน์ ภาษาอังกฤษ</th>
                                        <th>สถานะการอนุมัติ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="w-50">Communication Skills รุ่นที่ 1</td>
                                        <td class="w-25">Communication รุ่นที่ 1</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">Communication Skills รุ่นที่ 1</td>
                                        <td class="w-25">Communication รุ่นที่ 1</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">Communication Skills รุ่นที่ 1</td>
                                        <td class="w-25">Communication รุ่นที่ 1</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">Job observation</td>
                                        <td class="w-25">Job observation รุ่น 1/2024</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">test</td>
                                        <td class="w-25">หลักสูตรทดสอบ</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">หลักสูตรเฉพาะ/Specific course</td>
                                        <td class="w-25">SD3 System Overview</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">หลักสูตรเฉพาะ/Specific course</td>
                                        <td class="w-25">SD2 System overview</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
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



    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">อนุมัติหลักสูตรเฉพาะ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow: auto;">
                    <h3>ข้อมูล </h3>
                    <div class="card-body">
                        <fieldset disabled>
                            <div class="form-group">
                                <label for="namePupUp">วันที่เริ่มต้นการเรียน</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">วันที่สิ้นสุดการเรียน</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">จำนวนวันที่เข้าเรียนได้</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">เกณฑ์การสอบผ่าน *เปอร์เซ็น</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">จำนวนครั้งที่ทำข้อสอบได้</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">เวลาในการทำข้อสอบ</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">Create by</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">Org Chart</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxxxxx" required>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-primary">อนุมัติ</button>
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