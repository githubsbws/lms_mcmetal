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
                    <h4 class="m-0">รายงานผู้ผ่านการเรียน</h4>
                    <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    ค้นหา
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="form-group px-0 w-100">
                                            <label>ชื่อหลักสูตร (บังคับ)</label>
                                            <div class="w-100">
                                                <select class="form-select form-control" aria-label="Default select example">
                                                    <option selected>ทั้งหมด</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div class="form-group px-0 w-100">
                                            <label>รุ่น (บังคับ)</label>
                                            <div>
                                                <select class="form-select form-control" aria-label="Default select example">
                                                    <option selected>กรุณาเลือกหลักสูตร</option>
                                                    <option value="1">ไม่มีรุ่น</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-1 w-100">
                                            <label for="firstNameEN">ชื่อ-นามสกุล </label>
                                            <input type="text" class="form-control" id="firstNameEN" value="" required>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-1 w-100">
                                            <label for="lastNameEN">วันที่เริ่มต้น</label>
                                            <input type="text" class="form-control" id="lastNameEN" value="" required>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div class="form-group px-0 mr-1 w-100">
                                            <label for="positionTH">วันที่สิ้นสุด</label>
                                            <input type="text" class="form-control" id="positionTH" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary "><i class="fas fa-save mr-1"></i>ค้นหา</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-header">
                <div class="container-fluid mt-3">
                    <div class="card m-0">
                        <div class="card-header">
                            <i class='fas fa-list-ul mr-1'></i>
                            รายงานผู้ผ่านการเรียน
                        </div>
                        <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>Name – Surname</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>หลักสูตร</th>
                                        <th>รุ่น</th>
                                        <th>วันที่สอบผ่าน</th>
                                        <th>พิมพ์ใบผ่านการอบรม</th>
                                        <th>บันทึกใบผ่านการประกาศนียบัตร</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>BUNYARIT YUWAPONPANIT</td>
                                        <td>บุญฤทธิ์ ยุวพรพาณิชย์</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>CHIDAPA SIRIKANGWALKUL</td>
                                        <td>เชิญตะวัน จูประเสริฐ</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>CHURNTAWAN JUPRASERT</td>
                                        <td>ดำรงศักดิ์ แก้วพิลารมย์</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>DAMRONGSAK KAEWPILAROM</td>
                                        <td>บหทัยภัทร อังศุธรรมกุล</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>HATHAIPHAT ANGSUTHAMMAKUL</td>
                                        <td>กันต์ดนัย จินตนาการ</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>6</td>
                                        <td>KANDANAI CHINTANAKARN</td>
                                        <td>กัญฐิสา หงษ์ทอง</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>7</td>
                                        <td>KANTISA HONGTHONG</td>
                                        <td>กันยารัตน์ แสงทอง</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>8</td>
                                        <td>KANYARAT SAENGTHONG</td>
                                        <td>คมสัน วรจินดา</td>
                                        <td>Basic Power Point for Presentation</td>
                                        <td></td>
                                        <td>15 สิงหาคม 2565 13:32 น.</td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    พิมพ์
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <button href="" class="btn btn-success ">
                                                    <i class="fas fa-file-export mr-1"></i>
                                                    ดาวโหลด
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button href="" class="btn btn-success">
                                <i class="fas fa-file-export mr-1"></i>
                                ดาวโหลดทั้งหมด
                            </button>
                            <button href="" class="btn btn-danger">
                                <i class="fas fa-file-export mr-1" style="color: #ffa8a8;"></i>
                                Export Excel
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
        </div>
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
</body>

</html>