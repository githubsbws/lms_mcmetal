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
                    <h4 class="m-0">รีเซ็ตผลการเรียน การสอบ</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card m-0">
                        <div class="card-body">
                        <span class="badge badge-danger mb-2">* เมื่อทำการ Reset การสอบวัดผล ก่อนเรียน จะทำการ Reset ทุกอย่างเหมือนเรียนหลักสูตรใหม่ *</span>
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>ชือ-นามสกุล</th>
                                        <th>Reset การสอบวัดผล ก่อนเรียน</th>
                                        <th>Reset สอบก่อนเรียน</th>
                                        <th>Reset การเรียน</th>
                                        <th>Reset สอบหลังเรียน </th>
                                        <th>Reset การสอบวัดผล หลังเรียน</th>
                                        <th>หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>1</td>
                                        <td>PULLAPA ARNYONG</td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">
                                                รายละเอียด
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>RAEWADEE PHUNSON</td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">
                                                รายละเอียด
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>JATUPAT CHAIBOON</td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">
                                                รายละเอียด
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>SOMSAMORN MANOROTKUL</td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">
                                                รายละเอียด
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>WEAWTA DEANGBUBPA</td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-secondary btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button class="btn btn-danger btn-sm">
                                                    Reset
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm">
                                                รายละเอียด
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