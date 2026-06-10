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
                    <h4 class="m-0"> </h4>
                    <p class="m-0 text-black-50"></p>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="d-md-flex">
                        <div class="col mx-auto col-md-8 col-lg-6">
                            <div class="card m-0">
                                <div class="card-header bg-primary">
                                    Create
                                </div>
                                <div class="card-body">
                                    <p> Fields with <span class="text-danger"> * </span> are required.</p>

                                    <div class="form-group">
                                        <label for="namePupUp">Title <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" placeholder="title" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="namePupUp">Controller <span class="text-danger"> * </span></label>
                                        <input type="text" class="form-control" id="namePupUp" value="" placeholder="controller" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="namePupUp">Action </label>
                                    </div>
                                    <div class="card m-0 my-3">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="namePupUp">Title <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" id="namePupUp" value="" placeholder="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="namePupUp">Action <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" id="namePupUp" value="" placeholder="action" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card m-0 my-3">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="namePupUp">Title <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" id="namePupUp" value="" placeholder="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="namePupUp">Action <span class="text-danger"> * </span></label>
                                                <input type="text" class="form-control" id="namePupUp" value="" placeholder="action" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-danger btn-block "> - </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-block "> + </button>
                                        <p class="text-danger"> Press + to add another form field :3 </p>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary "><i class="fas fa-save mr-1"></i>Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Demo-LMS-New/admin/component/footer.php' ?>
</body>

</html>