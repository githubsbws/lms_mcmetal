<!DOCTYPE html>
<html lang="en">

<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';
?>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">จัดการเนื้อหาบทเรียนภาษาอังกฤษ</h4>
                            <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการแก้ไข</p>
                        </div>
                        <div class="ml-3">
                            <a href="/Demo-LMS-New/admin/pages/setting/lesson/">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าจัดการ
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    จัดการเนื้อหาบทเรียนภาษาอังกฤษ
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="typeLesson">หลักสูตรอบรมออนไลน์</label>
                                        <select class="form-control" id="typeLesson">
                                            <option>หลักสูตร</option>
                                            <option>หลักสูตร</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nameLesson">ชื่อเนื้อหาบทเรียน</label>
                                        <input type="text" class="form-control" id="nameLesson" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="percenPassBeforeClass">เปอร์เซ็นในการผ่านของ หลังเรียน</label>
                                        <input type="number" class="form-control" id="percenPassBeforeClass" value="60" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="countCanDo">จำนวนครั้งที่สามารถทำข้อสอบได้</label>
                                        <input type="number" class="form-control" id="countCanDo" value="1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="timeCount">เวลาในการทำข้อสอบ ทั้งก่อนและหลังเรียน</label>
                                        <input type="number" class="form-control" id="timeCount" value="60" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="summernote">เนื้อหา ภาษาอังกฤษ</label>
                                        <textarea id="summernote" name="detailLesson"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="fileType">ชนิดไฟล์บทเรียน</label>
                                        <select class="form-control" id="fileType">
                                            <option value="vdo" selected>VDO</option>
                                            <option value="pdf">PDF</option>
                                            <option value="scorm">SCORM</option>
                                            <option value="audio">AUDIO</option>
                                            <option value="youtube">YouTube</option>
                                            <option value="ebook">EBook</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="file_1">ไฟล์ประกอบบทเรียน (pdf)</label>
                                        <div class="custom-file mb-1">
                                            <input type="file" class="custom-file-input" id="file_1">
                                            <label class="custom-file-label" for="file_1">เลือกไฟล์ที่ต้องการ</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="file_2">ไฟล์ประกอบบทเรียน (pdf,docx,pptx)</label>
                                        <div class="custom-file mb-1">
                                            <input type="file" class="custom-file-input" id="file_2" accept=".pdf,.docx,.pptx">
                                            <label class="custom-file-label" for="file_2">เลือกไฟล์ที่ต้องการ</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="answer">เปิด ปิด เฉลยข้อสอบ</label>
                                        <select class="form-control" id="answer">
                                            <option value="none" selected>ไม่เลือกเฉลย</option>
                                            <option value="openAll">เฉลยข้อสอบภายหลัง</option>
                                            <option value="openSome">เฉลยข้อสอบทีละข้อ</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-0">
                                        <label for="file_2">รูปภาพ</label>
                                        <div class="custom-file mb-1">
                                            <input type="file" class="custom-file-input" id="file_2" accept=".pdf,.docx,.pptx">
                                            <label class="custom-file-label" for="file_2">เลือกไฟล์ที่ต้องการ</label>
                                        </div>
                                        <p class="text-danger mb-0">* รูปภาพควรมีขนาด 175x130(แนวนอน) หรือ ขนาด 175x(xxx) (แนวยาว)</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>

    </div>
    <script>
        $(document).ready(function() {
            // Summernote
            $('#summernote').summernote({
                placeholder: 'กรอกข้อมูลที่ต้องการแก้ไข',
                height: 150
            })
        })
    </script>
</body>
</html>