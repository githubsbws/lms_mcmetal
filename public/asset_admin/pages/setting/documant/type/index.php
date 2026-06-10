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
                    <h4 class="m-0">จัดการประเภทเอกสาร</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card m-0">
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                        <div class="form-check"> 
                                            <label>
                                                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
                                            </label>
                                        </div>
                                        </th>
                                        <th>ชื่อ</th>
                                        <th>ภาษา</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                </label>
                                            </div>
                                        </td>
                                        <td class="w-20">General knowledge</td>
                                        
                                        <td>
                                            <a href="./update/en/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                EN (เเก้ไข)
                                            </a>

                                            <a href="./update/th/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                                TH (เเก้ไข)
                                            </a>

                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex justify-content-start ">
                        <button class="btn btn-danger my-4 mx-2 btn-sm"> ลบข้อมูลทั้งหมด </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#settingTable').DataTable({
                responsive: true,
                scrollX: true,
                language: {
                    url: '/includes/languageDataTable.json',
                }
            });
        });
    </script>
    <script>
        // ฟังก์ชันสำหรับเลือกหรือยกเลิกการเลือก checkbox ทั้งหมด
        function toggleSelectAll(selectAllCheckbox) {
            const checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        }
    </script>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
</body>
</html>