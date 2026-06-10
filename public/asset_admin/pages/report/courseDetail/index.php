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
                                        <label for="inputText">ประเภทหลักสูตร</label>
                                        <select class="form-select" id="selectCourseType" aria-label="Default select example" style="width: 100%;">
                                          <option selected>กรุณาเลือกประเภทหลักสูตร</option>
                                          <option value="1">Specific Course</option>
                                          <option value="2">General Course</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">หมวดหมู่หลักสูตร</label>
                                        <select class="form-select" id="selectCourseType" aria-label="Default select example" style="width: 100%;">
                                          <option selected>Select Course Group</option>
                                          <option value="1">Group1</option>
                                          <option value="2">Group2</option>
                                          <option value="3">Group3</option>
                                          <option value="4">Group4</option>

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
                            รายงานรายละเอียดของหลักสูตร
                        </div>
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Minor Course Type</th>
                                        <th>Course Group</th>
                                        <th>Course Number</th>
                                        <th>Course Name</th>
                                        <th>Lesson Number</th>
                                        <th>Lesson</th>
                                        <th>Course Created Date</th>
                                        <th>Course Created By</th>
                                        <th>Lasted Edit Date</th>
                                        <th>Lasted Edit by</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>General Course</td>
                                        <td>หลักสูตรอบรม</td>
                                        <td>IH-0092</td>
                                        <td>Basic Grammar of Japanese Language</td>
                                        <td></td>
                                        <td>Lesson 1 I'm Anna</td>
                                        <td>26-Apr-2022</td>
                                        <td>admin_res</td>
                                        <td>20-May-2022</td>
                                        <td>admindemo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>General Course</td>
                                        <td>หลักสูตรอบรม</td>
                                        <td>IH-0080</td>
                                        <td>CR Techniques (เทคนิคการลดต้นทุน)</td>
                                        <td></td>
                                        <td>CR Techniques</td>
                                        <td>04-Jan-2024</td>
                                        <td>151cp1</td>
                                        <td>26-Jan-2024</td>
                                        <td>151cp1</td>
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