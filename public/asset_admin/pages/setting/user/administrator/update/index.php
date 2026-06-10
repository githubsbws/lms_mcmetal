<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<style>
    /* สไตล์สำหรับ input ที่เก็บ tag */
    .tags-input {
        display: flex;
        flex-wrap: wrap;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 4px;
        min-height: 38px;
        width: 70%;
        align-items: center;
        position: relative;
    }

    .tags-input input {
        border: none;
        outline: none;
        flex: 1;
        padding: 5px;
    }

    .tag {
        background-color: #007bff;
        color: white;
        border-radius: 3px;
        padding: 5px;
        margin: 2px;
        display: inline-flex;
        align-items: center;
    }

    .tag a {
        margin-left: 8px;
        color: white;
        text-decoration: none;
    }

    .tag a:hover {
        color: #ddd;
    }

    /* สไตล์สำหรับรายการตัวเลือก */
    .options-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        z-index: 1;
        display: none;
        max-height: 150px;
        overflow-y: auto;
    }

    .options-list li {
        padding: 10px;
        cursor: pointer;
    }

    .options-list li:hover {
        background-color: #f1f1f1;
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h4 class="m-0"> เเก้ไขผู้ดูแลระบบ</h4>
                    <p class="m-0 text-black-50">เพิ่มข้อมูลที่ต้องการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    เเก้ไขผู้ดูแลระบบ
                                </div>
                                <div class="card-body">
                                    <p> ค่าที่มี <span class="text-danger"> * </span> จำเป็นต้องใส่ให้ครบ </p>

                                    <div class="form-group">
                                        <label for="type">กลุ่มผู้ใช้ </label>
                                        <div class="tags-input" id="tags-input">
                                            <input type="text" id="type-input">
                                            <ul class="options-list" id="options-list" style="list-style: none;">
                                                <li data-value="System Admin">System Admin</li>
                                                <li data-value="Instructor's Manager">Instructor's Manager </li>
                                                <li data-value="Instructor">Instructor</li>
                                                <li data-value="HR Manager">HR Manager</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="division">Org. Chat ID <span class="text-danger"> * </span> </label>
                                        <select class="form-control" id="division">
                                            <option selected>AMD</option>
                                            <option value="1">POE</option>
                                            <option value="2">RPG</option>
                                            <option value="3">AKR</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> ชื่อผู้ใช้ </label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="ชื่อผู้ใช้" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> อีเมล </label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> รหัสผ่านใหม่</label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="รหัสผ่าน" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> ยืนยันรหัสผ่านใหม่ </label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="ยืนยันรหัสผ่าน" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> ชื่อ <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="ชื่อจริง" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> นามสกุล <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="นามสกุล" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> Firstname <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="firstname" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detailPopUp"> Lastname <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="division" value="" placeholder="lastname" required>
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
            let selectedTags = [];

            // ฟังก์ชันในการเพิ่ม tag ลงใน input
            function addTag(tag) {
                if (selectedTags.includes(tag)) return; // ถ้า tag ซ้ำ ให้ return
                selectedTags.push(tag);

                let tagElement = `<span class="tag">${tag} <a href="#" class="remove-tag" data-tag="${tag}">&times;</a></span>`;
                $('#tags-input').prepend(tagElement);
                $('#type-input').val(''); // ล้างค่าใน input
            }

            // เมื่อคลิกที่ input จะแสดงรายการตัวเลือก
            $('#type-input').on('focus', function() {
                $('#options-list').show();
            });

            // เมื่อเลือกตัวเลือกจากรายการ
            $('#options-list li').on('click', function() {
                let selectedOption = $(this).data('value');
                addTag(selectedOption);
                $('#options-list').hide(); // ซ่อนรายการหลังจากเลือกแล้ว
            });

            // ลบ tag เมื่อคลิกที่ "x"
            $(document).on('click', '.remove-tag', function(e) {
                e.preventDefault();
                let tag = $(this).data('tag');
                selectedTags = selectedTags.filter(t => t !== tag);
                $(this).parent().remove();
            });

            // ซ่อนรายการตัวเลือกเมื่อคลิกนอก input หรือรายการ
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#tags-input').length && !$(e.target).closest('#options-list').length) {
                    $('#options-list').hide();
                }
            });
        });
    </script>
</body>

</html>