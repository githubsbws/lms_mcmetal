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
                    <h4 class="m-0">จัดการปัญหาการใช้งาน</h4>
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
                                        <th>No.</th>
                                        <th>วันที่ส่ง</th>
                                        <th>ชื่อ-สกุล</th>
                                        <th>อีเมล์</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>ประเภทปัญหา</th>
                                        <th>ประเภทคอร์ส</th>
                                        <th>ข้อความ</th>
                                        <th>คำตอบ</th>
                                        <th>รูปภาพ</th>
                                        <th>ส่งข้อความ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>22 สิงหาคม 2567 09:50 น.</td>
                                        <td>ประดุง เกษมศาสตร์</td>
                                        <td>Pradung_Kasemsart@lsuzu.com</td>
                                        <td>0670451255</td>
                                        <td>2.Course</td>
                                        <td>IMCT IT system usage policy&amp; regulations</td>
                                        <td>ไม่พบคอร์สเรียน IMCT IT </td>
                                        <td> ยังไม่ได้ตอบ</td>
                                        <td class="text-center">รูป</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal">
                                                ส่งข้อความ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>22 สิงหาคม 2567 09:50 น.</td>
                                        <td>ประดุง เกษมศาสตร์</td>
                                        <td>Pradung_Kasemsart@lsuzu.com</td>
                                        <td>0670451255</td>
                                        <td></td>
                                        <td></td>
                                        <td>ไม่พบหลักสูตร </td>
                                        <td> ยังไม่ได้ตอบ</td>
                                        <td class="text-center">รูป</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal">
                                                ส่งข้อความ
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>22 สิงหาคม 2567 09:50 น.</td>
                                        <td>ประดุง เกษมศาสตร์</td>
                                        <td>Pradung_Kasemsart@lsuzu.com</td>
                                        <td>0670451255</td>
                                        <td>2.Course</td>
                                        <td>IMCT Cyber security</td>
                                        <td>ไม่สามารถเข้าอบรมหลักสูตรใดๆได้</td>
                                        <td> ยังไม่ได้ตอบ</td>
                                        <td class="text-center">รูป</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal">
                                                ส่งข้อความ
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



    <div class="modal fade" id="detailModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> ส่งข้อความ </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow: auto;">
                    <div class="form-group">
                        <input type="text" class="form-control" id="division" value="" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn btn-primary w-25">บันทึก</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#settingTable').DataTable({
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