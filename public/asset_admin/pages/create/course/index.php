<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<body class="hold-transition sidebar-mini" >
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper " >
            <div class="content-header">
                <div class="container-fluid">
                    <h4 class="m-0">เพิ่มหลักสูตร</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid" >
                    <div class="d-md-flex" >
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เพิ่มข่าวสารเเละกิจกรรม
                                </div>
                                <div class="card-body">
                                    <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>
                                    <div class="form-group">
                                        <label for="namePupUp">หมวดอบรมออนไลน์ ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <select class="form-control" id="className">
                                            <option value="" selected> ชื่อหลักสูตร </option>
                                            <option value="">ชื่อหลักสูตร</option>
                                            <option value="">ชื่อหลักสูตร</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="course">ชื่อหลักสูตรอบรมออนไลน์ ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="course" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pass">รหัสหลักสูตร ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="pass" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp">รายละเอียดย่อ ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <textarea class="form-control" id="detailPopUp" required></textarea>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="summernote">รายละเอียดหลักสูตร</label>
                                        <textarea id="summernote"></textarea>
                                    </div>

                                    <div class="form-group ">
                                        <label for="course">วันที่เริ่มต้นการเรียน ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control w-50" id="course" value="" required>
                                    </div>

                                    <div class="form-group ">
                                        <label for="course">วันที่สิ้นสุดการเรียน ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control w-50" id="course" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pass">จำนวนวันที่เข้าเรียนได้ ภาษาอังกฤษ <span class="text-danger"> * (หมายเหตุ จำนวนวันที่เข้าเรียนไม่ควรเกิน 9,999 วัน) </span></label>
                                        <input type="text" class="form-control" id="pass" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pass">เกณฑ์การสอบผ่าน *เปอร์เซ็น ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="pass" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pass">เวลาในการทำข้อสอบ ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="pass" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pass">รหัสหลักสูตร ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="pass" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="namePupUp">เปิด ปิด เฉลยข้อสอบ ภาษาอังกฤษ </label>
                                        <select class="form-control" id="className">
                                            <option value="" selected> ชื่อหลักสูตร </option>
                                            <option value="">ชื่อหลักสูตร</option>
                                            <option value="">ชื่อหลักสูตร</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> ปักหมุดหลักสูตรแนะนำ ภาษาอังกฤษ</label>
                                        <div>
                                            <input type="checkbox" checked data-toggle="toggle">
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <p class="mb-1 font-weight-bold">รูปภาพ ภาษาอังกฤษ</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="images">
                                            <label class="custom-file-label" for="images">เลือกรูป</label>
                                            <p class="mt-4"><span class="text-danger"> * รูปภาพควรมีขนาด 250x180(แนวนอน) หรือ ขนาด 250x(xxx) (แนวยาว) </span></p>
                                        </div>
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
        </div>
    </div>


    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>


    <script>
        $(document).ready(function() {
            // Summernote
            $('#summernote').summernote({
                placeholder: '',
                height: 150
            })
        })
    </script>
</body>

</html>