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
                                        <select class="form-select" id="selectCourse" aria-label="Default select example" style="width: 100%;" required>
                                          <option selected>ทั้งหมด</option>
                                          <option value="1">Course 1</option>
                                          <option value="2">Course 2</option>
                                          <option value="3">Course 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">เลือกบทเรียน</label>
                                        <select id="multiple" class="form-control form-control-chosen" data-placeholder="เลือกบทเรียน" multiple>
                                          <option>Option One</option>
                                          <option>Option Two</option>
                                          <option>Option Three</option>
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
                            รายงานวิเคราะห์คำตอบรายคำถาม
                        </div>
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th colspan="9"></th>
                                        <th colspan="2">Post-Test</th>
                                        <th colspan="9">จำนวนครั้งที่ตอบผิด (No. of Wrong Answer)</th>
                                    </tr>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Gen</th>
                                        <th>Group</th>
                                        <th>Employee Code</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Organization Unit</th>
                                        <th>Abbreviate Code</th>
                                        <th>Employee Class</th>
                                        <th>Score</th>
                                        <th>Percent</th>
                                        <th>Q1</th>
                                        <th>Q2</th>
                                        <th>Q3</th>
                                        <th>Q4</th>
                                        <th>Q5</th>
                                        <th>Q6</th>
                                        <th>Q7</th>
                                        <th>Q8</th>
                                        <th>Q9</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Course1 </td>
                                        <td>0</td>
                                        <td>71</td>
                                        <td>10000</td>
                                        <td>Don</td>
                                        <td>Joe</td>
                                        <td>710</td>
                                        <td>RMS</td>
                                        <td>M1</td>
                                        <td>9/9</td>
                                        <td>100.00%</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>1</td>
                                        <td>0</td>
                                        <td>0</td>
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
        $('.form-control-chosen').chosen();
        $('#settingTable').DataTable({
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
        });
});
</script>
</html>