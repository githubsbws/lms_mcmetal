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
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ค้นหา</h4>
                        </div>
                        <div class="ml-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="input-group">
                                <label for="search" class="input-group-text">ชื่อ:</label>
                                <input type="text" class="form-control" id="search">
                                <a href="">
                                    <button class="btn btn-danger">
                                        <i class="fa fa-search" style="color: #ffa8a8;"></i>
                                        Search
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-3">
                    <div class="card m-0">
                        <div class="card-header">
                            <i class='fas fa-list-ul mr-1'></i>
                            รายงานผลการอบรมรายบุคคล
                        </div>
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Emp ID</th>
                                        <th>Full Name</th>
                                        <th>Work Location</th>
                                        <th>Employee Class</th>
                                        <th>Minor course type</th>
                                        <th>Course Group</th>
                                        <th>Course Number</th>
                                        <th>Course Name</th>
                                        <th>Lesson</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>10000</td>
                                        <td>JOHN DOE</td>
                                        <td>SR</td>
                                        <td>A1</td>
                                        <td>General Course</td>
                                        <td>Course A</td>
                                        <td>001</td>
                                        <td>Course 1</td>
                                        <td>Lesson 1</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>10000</td>
                                        <td>JOHN DOE</td>
                                        <td>SR</td>
                                        <td>A2</td>
                                        <td>General Course</td>
                                        <td>Course B</td>
                                        <td>002</td>
                                        <td>Course 2</td>
                                        <td>Lesson 1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <p class="text-secondary m-0">*หากต้องการดูรายละเอียดกรุณากด Export Excel</p>
                            <a href="">
                                <button class="btn btn-danger">
                                    <i class="fas fa-file-export mr-1" style="color: #ffa8a8;"></i>
                                    Export Excel
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
</body>
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
</html>