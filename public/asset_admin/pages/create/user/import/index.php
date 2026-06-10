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
                    <h4 class="m-0">เพิ่มผู้ใช้งานจากตาราง Exel</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    นำเข้าจาก Excel
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-0">
                                        <p class="mb-1 font-weight-bold">นำเข้าไฟล์ สำหรับผู้เรียน</p>
                                        <p>(ไฟล์ excel เท่านั้น)</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="images">
                                            <label class="custom-file-label" for="images"></label>
                                        </div>
                                        <button type="button" class="btn btn-primary my-3">นำเข้าไฟล์ excel</button>
                                    </div>

                                    <div class=" form-group ">
                                        <p class="mb-2 font-weight-bold">แบบฟอร์มรูปแบบนำเข้าแบบทดสอบ</p>
                                        <button class="btn btn-success btn-block">
                                            <i class="fas fa-download mr-1"></i>ดาวน์โหลด
                                        </button>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary "><i class="fas fa-save mr-1"></i>บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-header mt-4">
                <div class="container-fluid">
                    <h4 class="m-0">รหัสที่ใช้ใน Excel</h4>
                    <p class="m-0 text-black-50"></p>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card m-0">
                    <div class="card-header">
                        <i class='fas fa-list-ul mr-1'></i>
                        รายงานวิเคราะห์คำตอบรายคำถาม
                    </div>
                    <div class="card-body">
                        <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center ">OrgChart ID</th>
                                    <th class="text-center ">Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>CFD</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>BPD</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>MKD</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>AMD</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>ASD</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>PMD</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>PPD</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>EGD</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card p-3 border">
                    <label class="my-3"> 2. Departmemt</label>
                    <table id="settingTable2" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center ">OrgChart ID</th>
                                <th class="text-center ">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>CFD</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BPD</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>MKD</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>AMD</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>ASD</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>PMD</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>PPD</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>EGD</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card p-3 border">
                    <label class="my-3"> 3. Group</label>
                    <table id="settingTable3" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center ">OrgChart ID</th>
                                <th class="text-center ">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>CFD</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BPD</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>MKD</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>AMD</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>ASD</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>PMD</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>PPD</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>EGD</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card p-3 border">
                    <label class="my-3"> 4. Section</label>
                    <table id="settingTable4" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center ">OrgChart ID</th>
                                <th class="text-center ">Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>CFD</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BPD</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>MKD</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>AMD</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>ASD</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>PMD</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>PPD</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>EGD</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
    <script>
        $(document).ready(function() {
            $('.form-control-chosen').chosen();
            $('#settingTable').DataTable({
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
            });
        });

        $(document).ready(function() {
            $('.form-control-chosen').chosen();
            $('#settingTable2').DataTable({
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
            });
        });

        $(document).ready(function() {
            $('.form-control-chosen').chosen();
            $('#settingTable3').DataTable({
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
            });
        });

        $(document).ready(function() {
            $('.form-control-chosen').chosen();
            $('#settingTable4').DataTable({
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
            });
        });
    </script>
</body>

</html>