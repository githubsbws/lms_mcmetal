<!DOCTYPE html>
<html lang="en">

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/header.php';  ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/navbar.php'; ?>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/sidebar.php'; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid d-flex align-items-center">
                    <div class="">
                        <h4 class="m-0">จัดการ Divison</h4>
                        <p class="m-0 text-black-50">เลือกรายการที่ต้องการจัดการ</p>
                    </div>
                    <div class="ml-3">
                        <a href="/Demo-LMS-New/admin/pages/create/Divison/">
                            <button class="btn btn-warning px-2 d-flex align-items-center">
                                <i class="fas fa-plus-circle pr-1"></i> เพิ่ม Divison
                            </button>
                        </a>
                    </div>
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
                                        <th>Division</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="w-75">CFD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">3</td>
                                        <td class="w-75">BPD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">4</td>
                                        <td class="w-75">MKD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">5</td>
                                        <td class="w-75">AMD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">6</td>
                                        <td class="w-75">ASD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">7</td>
                                        <td class="w-75">PMD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">8</td>
                                        <td class="w-75">PPD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">9</td>
                                        <td class="w-75">EGD</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-center">10</td>
                                        <td class="w-75">MND</td>
                                        <td>
                                            <a href="./update/" class="btn btn-warning btn-sm">
                                                <i class="fas fa-pen"></i>
                                            </a>
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