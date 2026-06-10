<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<style>
    .toolbar {
        border: 1px solid #ccc;
        padding: 5px;
        background-color: #f5f5f5;
    }

    .toolbar button {
        margin: 0 2px;
        padding: 5px;
        cursor: pointer;
    }

    .editor {
        border: 1px solid #ccc;
        padding: 10px;
        min-height: 200px;
        margin-top: 10px;
        background-color: #fff;
        overflow-y: auto;
        resize: vertical;
    }

    .hidden-textarea {
        display: none;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h4 class="m-0">เพิ่มวิดีโอ</h4>
                    <p class="m-0 text-black-50">กรอกข้อมูลที่ต้องการเพิ่ม</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เพิ่มวิดีโอ
                                </div>
                                <div class="card-body">
                                    <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>
                                    <div class="form-group">
                                        <label for="namePupUp">หัวข้อวิดีโอ ภาษาอังกฤษ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Link">เครดิต ภาษาอังกฤษ</label>
                                        <input type="text" class="form-control" id="link" value="" required>
                                    </div>

                                    <div class="form group">
                                        <label> ประเภทวิดีโอ ภาษาอังกฤษ </label>
                                        <select class="form-select form-control w-25" aria-label="Default select example">
                                            <option selected>ไฟล์</option>
                                            <option value="1">ลิงค์</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-0 mt-3">
                                        <p class="mb-1 font-weight-bold">ชื่อไฟล์วิดีโอ ภาษาอังกฤษ</p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="video">
                                            <label class="custom-file-label" for="video">เลือกวิดีโอ</label>
                                            <p class="text-danger my-2"> * ไฟล์ขนาดไม่เกิน 1 GB  </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary mt-3" onclick="saveContent()"><i class="fas fa-save mr-1"></i>บันทึก</button>
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
        function execCmd(command) {
            if (command === 'createLink') {
                const url = prompt('Enter the link here: ', 'http://');
                document.execCommand(command, false, url);
            } else {
                document.execCommand(command, false, null);
            }
        }

        function saveContent() {
            const editorContent = document.getElementById('editor').innerHTML;
            document.getElementById('hidden-textarea').value = editorContent;
            alert('Content saved to textarea!');
        }

        // Synchronize the contenteditable div with the textarea
        document.getElementById('editor').addEventListener('input', function() {
            document.getElementById('hidden-textarea').value = this.innerHTML;
        });
    </script>
</body>

</html>