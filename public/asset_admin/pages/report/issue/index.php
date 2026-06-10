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
                                        <label for="inputText">ชื่อ</label>
                                        <input type="text" class="form-control" id="inputText" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="datepicker">วันที่ส่งปัญหา</label>
                                        <input type="text" class="form-control" id="date" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText">Status</label>
                                        <select class="form-select" id="selectCourseType" aria-label="Default select example" style="width: 100%;">
                                          <option selected>ทั้งหมด</option>
                                          <option value="1">ตอบกลับแล้ว</option>
                                          <option value="2">ยกเลิก</option>
                                          <option value="3">ยังไม่ได้ตอบ</option>
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
                            รายงานปัญหาการใช้งาน
                        </div>
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>                            
                                        <th>Email</th>
                                        <th>Problem Type</th>
                                        <th>Course Name</th>
                                        <th>The Message</th>
                                        <th>Date of Issue</th>
                                        <th>Internal Phone No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>admin test</td>
                                        <td>test@test.com</td>
                                        <td>How to Use Microsoft Teams</td>
                                        <td></td>
                                        <td>test</td>
                                        <td>22 พฤศจิกายน 2564 14:44 น.</td>
                                        <td>0123456789</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>John Doe</td>
                                        <td>johndoe@gmail.com</td>
                                        <td>1.How to log-on & Forgot password</td>
                                        <td></td>
                                        <td>ไม่สามารถเปลี่ยน password ได้</td>
                                        <td>17 มีนาคม 2565 11:05 น.</td>
                                        <td>1218</td>
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
      $('#date').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        uiLibrary: 'bootstrap4'
      });
      $('#settingTable').DataTable({
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
        });
    });
</script>
</html>