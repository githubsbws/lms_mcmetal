<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    Update
                                </div>
                                <div class="card-body">
                                    <p> Fields with <span class="text-danger"> * </span> are required.</p>

                                    <div class="form-group">
                                        <label for="namePupUp">Group Name <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" placeholder="title" required>
                                    </div>


                                    <div class="form-group">
                                        <label for="namePupUp">Permission </label>
                                    </div>
                                    <div class="card m-0 my-3">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <table>
                                                    <tr>
                                                        <th class="w-50 py-1 pb-4">Controller</th>
                                                        <td class="w-50 py-1 pb-4">ระบบจัดการ Employee Class</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="py-3">Action</th>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    จัดการ Employee class
                                                                </label>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <th class="pt-4 pb-1">Active</th>
                                                        <td class="pt-4 pb-1">
                                                            <div>
                                                                <input type="checkbox" checked data-toggle="toggle">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card m-0 my-3">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <table>
                                                    <tr>
                                                        <th class="w-50 py-1 pb-4">Controller</th>
                                                        <td class="w-50 py-1 pb-4">ระบบจัดการ Employee Class</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="py-3">Action</th>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    ดูข้อความ
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    ตอบกลับข้อความ
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    ออกรายงาน
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    แก้ไข
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    ลบข้อมูล
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    เพิ่มข้อมูล
                                                                </label>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <th class="pt-4 pb-1">Active</th>
                                                        <td class="pt-4 pb-1">
                                                            <div>
                                                                <input type="checkbox" checked data-toggle="toggle">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary "><i class="fas fa-save mr-1"></i>Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
</body>

</html>