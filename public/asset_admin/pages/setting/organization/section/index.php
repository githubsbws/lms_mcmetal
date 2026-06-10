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
                    <h4 class="m-0">จัดการ Section</h4>
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
                                        <th>ID</th>
                                        <th>Section</th>
                                        <th>Group</th>
                                        <th>Department</th>
                                        <th>Division</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <td class="text-center">109</td>
                                        <td>BPS</td>
                                        <td>BPG</td>
                                        <td>CBD</td>
                                        <td>CFD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">111</td>
                                        <td>CCS</td>
                                        <td>CCG</td>
                                        <td>SDD</td>
                                        <td>BPD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">145</td>
                                        <td>SD1</td>
                                        <td>CBD</td>
                                        <td>F&A</td>
                                        <td>MKD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">146</td>
                                        <td>SD2</td>
                                        <td>SDG</td>
                                        <td>PSL</td>
                                        <td>AMD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">155</td>
                                        <td>SD3</td>
                                        <td>SOG</td>
                                        <td>MKR</td>
                                        <td>ASD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">157</td>
                                        <td>SD4</td>
                                        <td>ACC</td>
                                        <td>BOD</td>
                                        <td>PMD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">158</td>
                                        <td>SAS</td>
                                        <td>FIG</td>
                                        <td>HRM</td>
                                        <td>PPD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">159</td>
                                        <td>ISS</td>
                                        <td>PS1</td>
                                        <td>GAD</td>
                                        <td>EGD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">160</td>
                                        <td>SCS</td>
                                        <td>PS2</td>
                                        <td>SHD</td>
                                        <td>MND</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
    </div>
</body>

</html>