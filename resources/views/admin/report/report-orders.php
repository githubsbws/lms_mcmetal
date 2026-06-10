<?php include 'head.php' ?>

<body class="">

	<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">

		<!-- Top navbar -->
		<?php include 'top-nav.php' ?>
		<!-- Top navbar END -->


		<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">

			<!-- Sidebar Menu -->
			<?php include 'menu-left.php' ?>
			<!-- // Sidebar Menu END -->


			<!-- Content -->
			<!-- <div class="span-19"> -->
			<div id="content">
				<!-- breadcrumbs -->
				<div class="separator bottom"></div>
				<div class="innerLR">
					<!-- Box -->
					<div class="hero-unit well">
						<h1>Ouch! <span>404 error</span></h1>
						<hr class="separator">
						<!-- Row -->
						<div class="row-fluid row-merge">

							<!-- Column -->
							<div>
								<div class="innerAll left">
									<p>It seems the page you are looking for is not here anymore. The page might have moved to another address or just removed by our staff.</p>
								</div>
							</div>
							<!-- // Column END -->


						</div>
						<!-- // Row END -->

					</div>
					<!-- // Box END -->
				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
			<!-- </div> -->
			<!-- <div class="span-5 last"> -->
			<!-- </div> -->
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->

		<div id="footer" class="hidden-print">

			<!--  Copyright Line -->
			<div class="copy">© 2023 - All Rights Reserved.</a></div>
			<!--  End Copyright Line -->

		</div>
		<!-- // Footer END -->

	</div>

</body>

<?php include 'footer.php' ?>
<?php
$titleName = 'รายงานการสั่งซื้อ';
$formNameModel = 'Report';
$this->breadcrumbs = array($titleName);

// var_dump($_GET);exit();

$criteria = new CDbCriteria;
$criteria->with = array('OrdersDetail');
$criteria->compare('t.active', '1');
$criteria->order = "t.id DESC";

if (isset($_GET['course']) && $_GET['course'] != null) {
    $criteria->compare('course_id', $_GET['course']);
}

if (isset($_GET['period_start']) && $_GET['period_start'] != null) {
    $criteria->addcondition('order_date >= "' . date('Y-m-d 00:00:00', strtotime($_GET['period_start'])) . '"');
}
if (isset($_GET['period_end']) && $_GET['period_end'] != null) {
    $criteria->addcondition('order_date <= "' . date('Y-m-d 23:59:59', strtotime($_GET['period_end'])) . '"');
}



if (isset($_GET['pay']) && $_GET['pay'] != null) {

    if ($_GET['pay'] == 1) {
        $criteria->addcondition('status_pay = 1'); // pay 1 คือยังไม่จ่าย
    } else {
        $criteria->addcondition('status_pay > 1'); // pay 2 3 คือจ่ายแล้ว
    }
}
$model = orders::model()->findAll($criteria);

// var_dump($model);exit();
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-chosen.css" />
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/chosen.jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $(".chosen").chosen();
        $(".widget-body").css("overflow", "");

        $("#Report_period_start").datepicker({
            onSelect: function(selected) {
                $("#Report_period_end").datepicker("option", "minDate", selected)
            }
        });
        $("#Report_period_end").datepicker({
            onSelect: function(selected) {
                $("#Report_period_start").datepicker("option", "maxDate", selected)
            }
        });

        endDate();
        startDate();
    });

    function startDate() {
        $('#Report_period_start').datepicker({
            dateFormat: 'yyyy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true,
            onSelect: function() {
                $("#passcoursEndDateBtn").datepicker("option", "minDate", this.value);
            },
        });
    }

    function endDate() {
        $('#Report_period_end').datepicker({
            dateFormat: 'yyyy-mm-dd',
            showOtherMonths: true,
            selectOtherMonths: true,
        });
    }
</script>
<div class="innerLR">
    <div class="widget" data-toggle="collapse-widget" data-collapse-closed="false">
        <div class="widget-head">
            <h4 class="heading  glyphicons search"><i></i>ค้นหา</h4>
            <span class="collapse-toggle"></span>
        </div>



        <div class="widget-body of-out in collapse" style="height: auto;">
            <div class="search-form">
                <div class="wide form" style="padding-top:6px;">
                    <form id="SearchFormAjax" action="<?= $this->createUrl('Report/orders') ?>" method="get">
                        <?php $modelCourse = CourseOnline::model()->findAll(array('condition' => 'active = "y" AND lang_id = 1')); ?>
                        <div class="row">
                            <label>หลักสูตร</label>
                            <select class="span6 " name="course" id="course">
                                <option value="">ทั้งหมด</option>
                                <?php foreach ($modelCourse as $data => $value) { ?>
                                    <option value="<?php echo $value->id ?>" <?php if ($_GET["course"] == $value->id) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $value->course_title ?></option>
                                <?php } ?>

                            </select>

                        </div>

                        <div class="row">
                            <label>สถานะการจ่าย</label>
                            <select class="span6 " name="pay" id="pay">
                                <option value="">ทั้งหมด</option>
                                <option value="1" <?php if ($_GET["pay"] == 1) {
                                                        echo "selected";
                                                    } ?>>ยังไม่จ่าย</option>
                                <option value="2" <?php if ($_GET["pay"] == 2) {
                                                        echo "selected";
                                                    } ?>>จ่ายแล้ว</option>

                            </select>

                        </div>
                        <div class="row"><label>วันที่เริ่มต้น</label><input class="span6" autocomplete="off" name="period_start" id="Report_period_start" type="text" value="<?= $_GET["period_start"] ?>"></div>
                        <div class="row"><label>วันที่สิ้นสุด</label><input class="span6" autocomplete="off" name="period_end" id="Report_period_end" type="text" value="<?= $_GET["period_end"] ?>"></div>
                        <div class="row"><button type="submit" class="btn btn-primary mt-10 btn-icon glyphicons search"><i></i> ค้นหา</button></div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>
<?php

if (!empty($model)) {
?>

    <div class="widget" style="margin-top: 10px;">
        <div class="widget-head">
            <h4 class="heading glyphicons show_thumbnails_with_lines"> <i></i> รายงานการสั่งซื้อ</h4>
        </div>

        <div class="widget-body" style=" overflow-x: scroll;">
            <div class="clear-div"></div>
            <div class="overflow-table">
                <table class="table table-bordered table-striped" id="data-table">
                    <thead>
                        <tr>
                            <!-- <th  class="center" width="5%" style="vertical-align:middle;">Order_id</th>
                                    <th  class="center" width="5%" style="vertical-align:middle;">User id</th> -->
                            <th class="center" width="" style="vertical-align:middle;">วันที่ลงทะเบียน</th>
                            <th class="center" width="" style="vertical-align:middle;">ชื่อ-นามสกุลผู้ซื้อ</th>
                            <th class="center" width="" style="vertical-align:middle;">Tax ID ผู้ซื้อ</th>
                            <th class="center" width="" style="vertical-align:middle;">เบอร์โทร</th>
                            <th class="center" width="" style="vertical-align:middle;">อีเมล</th>
                            <th class="center" width="" style="vertical-align:middle;">อาชีพ</th>
                            <th class="center" width="" style="vertical-align:middle;">รู้จักผ่านช่องทางใด</th>
                            <th class="center" width="" style="vertical-align:middle;">มี user อยู่แล้วไหม</th>
                            <th class="center" width="" style="vertical-align:middle;">ชื่อหลักสูตรที่ลงทะเบียน</th>
                            <th class="center" width="" style="vertical-align:middle;">รหัสหลักสูตร</th>
                            <th class="center" width="" style="vertical-align:middle;">ออกใบเสร็จในนาม</th>

                            <th class="center" width="" style="vertical-align:middle;">ชื่อ ผู้ออกใบเสร็จ</th>
                            <th class="center" width="" style="vertical-align:middle;">Tax ID ผู้ออกใบเสร็จ</th>
                            <th class="center" width="" style="vertical-align:middle;">ที่อยู่ ผู้ออกใบเสร็จ</th>
                            <th class="center" width="" style="vertical-align:middle;">หักภาษี ณ ที่ จ่าย</th>
                            <th class="center" width="" style="vertical-align:middle;">สถานะการจ่าย</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($model as $data => $value) {
                        ?>
                            <tr>
                                <!-- <td><?php echo $i++; ?></td> -->
                                <td><?php echo $value->order_date ?></td>
                                <td><?php echo $value->order_firstname ?> <?php echo $value->order_lastname ?></td>
                                <td><?php echo $value->tax_id_card ?></td>
                                <td><?php echo $value->order_tel ?></td>
                                <td><?php echo $value->order_email ?></td>
                                <td><?php echo $value->order_emp_type ?></td>
                                <td><?php echo $value->order_know ?></td>
                                <td><?php echo $value->order_account ?></td>
                                <td>
                                    <?php
                                    $criteria = new CDbCriteria;
                                    $criteria->compare('orders_id', $value->id);
                                    $criteria->order = "id DESC";
                                    $OrdersDetail = OrdersDetail::model()->findAll($criteria);

                                    foreach ($OrdersDetail as $dataDetail => $valueDetail) {
                                        echo $valueDetail->courseonlines->course_title;
                                        echo "<br>";
                                    }
                                    ?>
                                </td>
                                <td><?php
                                
                                    foreach ($OrdersDetail as $dataDetail => $valueDetail) {
                                        echo $valueDetail->courseonlines->course_number;
                                        echo "<br>";
                                    }

                                    ?>
                                </td>
                                <td><?php echo $value->order_tax_type ?></td>

                                <td><?php
                                    if ($value->order_tax_type == "ในนามบุคคล") {
                                        echo $value->tax_firstname . " ";
                                        echo $value->tax_lastname;
                                    } else {
                                        echo $value->tax_org_name;
                                    }

                                    ?>
                                </td>
                                <td><?php echo $value->tax_id ?></td>
                                <td><?php
                                    if ($value->order_tax_type == "ในนามบุคคล") {
                                        echo $value->tax_addr . " ";
                                        echo $value->tax_city . " ";
                                        echo $value->tax_province . " ";
                                        echo $value->tax_postal_code . " ";
                                        echo $value->tax_country;
                                    } else {
                                        echo $value->tax_org_addr . " ";
                                        echo $value->tax_org_city . " ";
                                        echo $value->tax_org_state . " ";
                                        echo $value->tax_org_postal_code . " ";
                                        echo $value->tax_org_country;
                                    }

                                    ?></td>
                                <td>
                                    <?php
                                    if ($value->tax_org_need == 1) {
                                        echo "มี";
                                    } else {
                                        echo "ไม่มี";
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    if ($value->status_pay == 1) {
                                        echo "ยังไม่จ่าย";
                                    } else {
                                        echo "จ่ายแล้ว";
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php } ?>




                    </tbody>
                </table>
            </div><!-- overflow-table -->
        </div><!-- widget-body -->

    </div>

    <a href="<?= $this->createUrl('Report/ExcelByOrders', array(
                    'period_start' => $_GET['period_start'],
                    'period_end' => $_GET['period_end'],
                    'pay' => $_GET['pay'],
                    'course' => $_GET['course'],
                )); ?>" target="_blank" class="btn btn-primary btn-icon glyphicons file"><i></i> Export Excel</a>



<?php } else { ?>
    <div class="widget" style="margin-top: -1px;">
        <div class="widget-head">
            <h4 class="heading glyphicons show_thumbnails_with_lines">
                <i></i>
            </h4>
        </div>
        <div class="widget-body">
            <!-- Table -->
            <h3 class="text-success">กรุณาป้อนข้อมูลให้ถูกต้อง แล้วกด ปุ่มค้นหา</h3>
            <!-- // Table END -->
        </div>
    </div>
<?php } ?>

<script>
    // $(document).ready( function {
    //   $('#data-table').dataTable( {
    //     "bPaginate": false,
    //     "bSort": false
    //   } );
    // } );


    $(document).ready(function() {
        $('#data-table').dataTable({
            "bSort": false,
            // "sDom": 'T<"clear">lfrtip',
            // "oTableTools": {
            // 	"aButtons": [ "copy", "print" ]
            // }
            "iDisplayLength": 50
        });
    });
</script>