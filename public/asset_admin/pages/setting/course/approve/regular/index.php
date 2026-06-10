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
                    <h4 class="m-0">จัดการอนุมัติหลักสูตร ทั่วไป</h4>
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
                                        <td class="w-50">หลักสูตรอบรมตามกฎหมาย/Manded by Law</td>
                                        <td class="w-25">Value Engineering</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">หลักสูตรอบรมตามกฎหมาย/Manded by Law</td>
                                        <td class="w-25">Why-Why analysis and 8D technique</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">หลักสูตรอบรมตามกฎหมาย/Manded by Law</td>
                                        <td class="w-25">บันทึกการประชุมชี้แจงการประเมิน 360 องศา</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">หลักสูตรอบรมตามความจำเป็นสำหรับพนักงาน/Manded by IMCT</td>
                                        <td class="w-25">CR Techniques (เทคนิคการลดต้นทุน)</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">หลักสูตรอบรมตามความจำเป็นสำหรับพนักงาน/Manded by IMCT</td>
                                        <td class="w-25">Value Engineering</td>
                                        <td>ยังไม่อนุมัติ</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal">
                                                จัดการ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="w-50">หลักสูตรอบรมตามความจำเป็นสำหรับพนักงาน/Manded by IMCT</td>
                                        <td class="w-25">Phishing Security Awareness</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">อนุมัติหลักสูตรทั่วไป</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow: auto;">
                    <h3>ข้อมูล </h3>
                    <div class="card-body">
                        <fieldset disabled>
                            <div class="form-group">
                                <label for="namePupUp">หลักสูตร</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">หมวด</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">รหัสหลักสูตร</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">รายละเอียดย่อ</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">วันที่เริ่มต้นการเรียน</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">วันที่สิ้นสุดการเรียน</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">จำนวนวันที่เข้าเรียนได้</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">เกณฑ์การสอบผ่าน *เปอร์เซ็น</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">จำนวนครั้งที่ทำข้อสอบได้</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">เวลาในการทำข้อสอบ</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">Create by</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="namePupUp">Org Chart</label>
                                <input type="text" class="form-control" id="namePupUp" value="xxxxxx" required>
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