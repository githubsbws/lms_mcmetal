<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>
<style>
     .profile-container {
            margin-top: 50px;
    
            
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border: 2px solid #ccc;
            border-radius: 10%;
            background-image: url('https://via.placeholder.com/150');
            background-size: cover;
            background-position: center;
            display: inline-block;
        }
        .upload-btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #f0f0f0;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .upload-btn:hover {
            background-color: #e0e0e0;
        }
        .content{
            margin-left: 200px;
        }
        .selectP{
            width: 210px;
        }
</style>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h4 class="m-0">เพิ่มผู้ใช้งาน</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div> 
            <div class="content">
                <div class="container">
                    <div class="profile-container">
                     <div class="profile-picture"></div>
                        <br>
                        <input type="file" id="fileUpload" style="display: none;" />
                        <label for="fileUpload" class="upload-btn ">เลือกรูป </label>
                    </div>
                    <form action="">
                    <label for="exampleInputEmail1" class="form-label">Org. Chat ID </label><br>
                    <select class="form-select p-1 selectP" aria-label="Default select example ">
                        <option selected>CFD</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                        <div class="mb-3 mt-3">
                            <label class="form-label">
                                <h6>ชื่อผู้ใช้</h6>
                                <input type="text" value="รหัสพนักงาน" class="form-control">
                            </label>
                            <label class="form-label m-3">
                                <h6>อีเมล</h6>
                                <input type="text" value="อีเมล" class="form-control">
                            </label>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">
                                <h6 class="fw-light">ชื่อ</h6>
                                <input type="text" value="ชื่อจริง" class="form-control">
                            </label>
                            <label class="form-label m-3">
                                <h6 class="fw-light">นามสกุล</h6>
                                <input type="text" value="นามสกุล" class="form-control">
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <h6 class="fw-light">First name</h6>
                                <input type="text" value="ชื่ออังกฤษ" class="form-control">
                            </label>
                            <label class="form-label m-3">
                                <h6 class="fw-light">Last name</h6>
                                <input type="text" value="นามสกุลอังกฤษ" class="form-control" id="">
                            </label>
                            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <h6 class="fw-light">ประเภทพนักงาน</h6>
                                <input type="text" value="ประเภทพนักงาน เช่น P หรือ J" class="form-control">
                            </label>
                            <label class="form-label m-3">
                                <h6 class="fw-light">รหัสส่วนงาน</h6>
                                <input type="texts" value="รหัสส่วนงาน" class="form-control" id="">

                            </label>
                            <label class="form-label m-3">
                                <h6 class="fw-light">ชื่อส่วนงาน</h6>
                                <input type="text" value="ชื่อส่วนงาน" class="form-control" id="">
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <h6 class="fw-light">สถานที่ทำงาน</h6>
                                <input type="text" value="สถานที่ทำงาน เช่น SR หรือ GW" class="form-control">
                            </label>
                            <label class="form-label m-3">
                                <h6 class="fw-light">Group</h6>
                                <input type="text" value="รหัสกลุ่มงาน" class="form-control" id="">

                            </label>
                            <label class="form-label m-3">
                                <h6 class="fw-light">Shift</h6>
                                <input type="text" value="กะทำงาน เช่น A B หรือ Z" class="form-control" id="">
                            </label>
                        </div>
                        
                        <div class="mb-3 d-flex">
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Employee class</label><br>
                        <select class="form-select p-1" aria-label="Default select example">
                            <option selected>--กรุณาเลือก Employee class-- </option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                             <option value="3">3</option>
                        </select>
                    </div>
                    
                    <div class=" g-3 align-items-center">

                        <div class="col-auto">
                        <label for="exampleInputEmail1" class="form-label">Position description</label>
                            <input type="text" value="Position description" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                        </div>
                    </div>

                    <div>
                        <label for="exampleInputEmail1" class="form-label">เพศ</label><br>
                        <select class="form-select p-1 selectP" aria-label="Default select example">
                            <option selected>ระบุ </option>
                            <option value="1">ชาย</option>
                            <option value="2">หญิง</option>
                             <option value="3">อื่นๆ</option>
                        </select>
                    </div>
                        </div>
                        <label for="" style="margin-left:30%;"><button type="submit" class="btn btn-primary">เพิ่มสมาชิก</button></label>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
</body>
</html>