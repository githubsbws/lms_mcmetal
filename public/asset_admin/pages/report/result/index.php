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
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputText">เลือกหลักสูตร (บังคับ)</label>
                                        <select class="form-select" id="selectCourseType" aria-label="Default select example" style="width: 100%;" required>
                                          <option selected>ทั้งหมด</option>
                                          <option value="1">Course 1</option>
                                          <option value="2">Course 2</option>
                                          <option value="3">Course 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">รุ่น (บังคับ)</label>
                                        <select class="form-select" id="selectCourseType" aria-label="Default select example" style="width: 100%;" required>
                                          <option selected disabled>กรุณาเลือกรุ่น</option>
                                          <option value="1">ไม่มีรุ่น</option>
                                        </select>
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="card-footer">
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
                </div>
                <div class="container-fluid mt-3">
                    <div class="card m-0">
                        <div class="card-header">
                            <i class='fas fa-list-ul mr-1'></i>
                            รายงานการฝึกอบรมหลักสูตร
                        </div>
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Minor course type</th>
                                        <th>Subminor course type</th>
                                        <th>Course Name</th>
                                        <th>Group</th>
                                        <th>Employee</th>
                                        <th>Name</th>
                                        <th>Organization unit</th>
                                        <th>Abbreviate code</th>
                                        <th>Employee class</th>
                                        <th>Position desc.</th>
                                        <th>Learning Status</th>
                                        <th>Completed Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>General Course</td>
                                        <td>24-01</td>
                                        <td>Course 1 </td>
                                        <td>71</td>
                                        <td>10000</td>
                                        <td>John Doe</td>
                                        <td>1</td>
                                        <td>A</td>
                                        <td>M1</td>
                                        <td>Senior Chief</td>
                                        <td>Completed</td>
                                        <td>2024-04-23 07:44:42</td>
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