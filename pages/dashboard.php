<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php include 'includes/header.php'; ?>	
    </head>

    <body>

        <div id="wrapper">

            <?php include 'includes/headerone.php'; ?>


            <div id="sidebar-wrapper" class="collapse sidebar-collapse">

                <?php
                include 'includes/navigation.php';
                ?>

            </div> <!-- /#sidebar-wrapper -->


            <div id="content">		

                <div id="content-header">
                    <h1>Dashboard</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">

                    <div class="row">

                        <div class="col-md-3 col-sm-6">

                            <a href="javascript:;" class="dashboard-stat primary">
                                <div class="visual">
                                    <i class="fa fa-star"></i>
                                </div> <!-- /.visual -->

                                <div class="details">
                                    <span class="content">Mapped Girls</span>
                                    <span class="value">
                                        <?php
                                        $mother_counter = 0;
                                        $mother_count = DB::getInstance()->query("SELECT * FROM core_patients");
                                        foreach ($mother_count->results() as $mother_count) {
                                            $mother_counter++;
                                        }
                                        echo seperators($mother_counter);
                                        ?></span>
                                </div> <!-- /.details -->

                                <i class="fa fa-play-circle more"></i>

                            </a> <!-- /.dashboard-stat -->

                        </div> <!-- /.col-md-3 -->

                        <div class="col-md-3 col-sm-6">

                            <a href="javascript:;" class="dashboard-stat secondary">
                                <div class="visual">
                                    <i class="fa fa-shopping-cart"></i>
                                </div> <!-- /.visual -->

                                <div class="details">
                                    <span class="content">User Groups</span>
                                    <span class="value"> <?php
//                                            $counter_cart = 0;
//                                            $orders_cart = DB::getInstance()->query("SELECT * FROM jerm_cart GROUP BY User_Id");
//                                            foreach ($orders_cart->results() as $orders_cart) {
//                                                $counter_cart++;
//                                            }
                                        echo seperators(2);
                                        ?></span>
                                </div> <!-- /.details -->

                                <i class="fa fa-play-circle more"></i>

                            </a> <!-- /.dashboard-stat -->

                        </div> <!-- /.col-md-3 -->

                        <div class="col-md-3 col-sm-6">

                            <a href="javascript:;" class="dashboard-stat tertiary">
                                <div class="visual">
                                    <i class="fa fa-clock-o"></i>
                                </div> <!-- /.visual -->

                                <div class="details">
                                    <span class="content">Registered Users</span>
                                    <span class="value"><?php
                                        $counter_users = 0;
                                        $_users = DB::getInstance()->query("SELECT * FROM jerm_users");
                                        foreach ($_users->results() as $_users) {
                                            $counter_users++;
                                        }
                                        echo seperators($counter_users);
                                        ?></span>
                                </div> <!-- /.details -->

                                <i class="fa fa-play-circle more"></i>

                            </a> <!-- /.dashboard-stat -->

                        </div> <!-- /.col-md-3 -->

                        <div class="col-md-3 col-sm-6">

                            <a href="javascript:;" class="dashboard-stat">
                                <div class="visual">
                                    <i class="fa fa-money"></i>
                                </div> <!-- /.visual -->

                                <div class="details">
                                    <span class="content">Composed Messages</span>
                                    <span class="value"><?php
                                        $counter_revenue = 0;
                                        echo $counter_revenue;
                                        ?></span>
                                </div> <!-- /.details -->

                                <i class="fa fa-play-circle more"></i>

                            </a> <!-- /.dashboard-stat -->

                        </div> <!-- /.col-md-9 -->



                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table 
                                    class="table table-striped table-hover table-highlight table-checkable" 
                                    data-provide="datatable" 
                                    border="1"
                                    data-info="true"
                                    data-search="true"
                                    data-length-change="true"
                                    data-paginate="true"
                                    >
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" width="40%">AGE Groups</th>
                                            <?php
                                            $group1 = 0;
                                            $group2 = 0;
                                            $group3 = 0;
                                            $age_groups = DB::getInstance()->query("SELECT * FROM core_patients");
                                            foreach ($age_groups->results() as $age_groups) {
                                                $age = calcAge($age_groups->dob, date('Y-m-d'));
                                                if ($age >= 15 && $age <= 19):
                                                    $group1++;
                                                elseif ($age >= 20 && $age <= 24):
                                                    $group2++;
                                                elseif ($age >= 25 && $age <= 30):
                                                    $group3++;
                                                else:
                                                endif;
                                            }
                                            ?>
                                            <td width="60%">(15-19):    <?php echo $group1; ?> Girls<br/>(20-24):    <?php echo $group2; ?>  Girls<br/>(24-30):    <?php echo $group3; ?>  Girls<br/>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th data-direction="asc" data-filterable="true" data-sortable="true">Mapped Girls</th>
                                            <td><?php echo $mother_counter; ?> </td>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true" width="40%">Personnel</th>
                                            <td width="60%">VHT:    0 <br/>Mid Wives:    0 <br/>Drivers:    <?php echo DB::getInstance()->returnCount("select * from core_ambulancedriver"); ?> <br/>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table 
                                    class="table table-striped table-hover table-highlight table-checkable" 
                                    data-provide="datatable" 
                                    border="1"
                                    data-info="true"
                                    data-search="true"
                                    data-length-change="true"
                                    data-paginate="true"
                                    >
                                    <thead>
                                        <tr>
                                            <th data-sortable="true" width="40%">Visits</th>
                                            <td width="60%">Scheduled Visits    <?php echo DB::getInstance()->returnCount("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id"); ?><br/>
                                                Visited Today:    <?php echo DB::getInstance()->returnCount("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id"); ?><br/>
                                                Missed Visit:    <?php echo DB::getInstance()->returnCount("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id"); ?><br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $cug = DB::getInstance()->query("SELECT * FROM core_patients");
                                            $mtn=0;
                                            $airtel=0;
                                            $pending=0;
                                            foreach ($cug->results() as $cug) {
                                                $phone1 = str_split($cug->pnumber);
                                                $phone2 = str_split($cug->holder_pnumber);
                                                
                                                $pattern1 = $phone1[0] . "" . $phone1[1] . "" . $phone1[2];
                                                $pattern2 = $phone2[0] . "" . $phone2[1] . "" . $phone2[2];
                                                if ($pattern1 == '078' || $pattern1 == '077' || $pattern1 == '075' || $pattern1 == '070'){

                                                if ($pattern1 == '078' || $pattern1 == '077'):
                                                $mtn++;
                                                elseif($pattern1 == '075' || $pattern1 == '070'):
                                                $airtel++;
                                                endif;
                                                
                                                
                                                if ($pattern2 == '075' || $pattern2 == '070'):
                                                $airtel++;
                                                elseif($pattern2 == '078' || $pattern2 == '077'):
                                                $mtn++;
                                                endif;
                                            }
                                            else{
                                                $pending++;
                                            }
                                            }
                                            ?>
                                            <th data-sortable="true" width="40%">User Groups</th>
                                            <td width="60%">MTN:    <?php echo $mtn; ?> <br/>Airtel:    <?php echo $airtel; ?> <br/>Pending:    <?php echo $pending; ?> <br/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true" width="40%">Composed Broad Cast Messages</th>
                                            <td width="60%"> <?php echo DB::getInstance()->returnCount("select * from messages"); ?>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-12">



                            <div class="row">

                                <div class="col-md-6">

                                    <div class="portlet">

                                        <div class="portlet-header">

                                            <h3>
                                                <i class="fa fa-money"></i>
                                                Recent Pregnant Mothers
                                            </h3>

                                            <ul class="portlet-tools pull-right">
                                                <li>
                                                    <button class="btn btn-sm btn-default">
                                                        <a href="index.php?page=demographics"> ALL </a>
                                                    </button>
                                                </li>
                                            </ul>

                                        </div> <!-- /.portlet-header -->

                                        <div class="portlet-content">

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Mother Names</th>
                                                            <th>Phone Number</th>
                                                            <th>Power Holder</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
$users_list = DB::getInstance()->query("SELECT * FROM core_patients order by subject_ptr_id desc limit 10");
foreach ($users_list->results() as $users_list) {
    ?>
                                                            <tr>
                                                                <td><?php echo $users_list->given_name . " " . $users_list->family_name; ?></td>

                                                                <td><?php echo $users_list->pnumber; ?></td>
                                                                <td><?php echo $users_list->holder_pnumber; ?>
                                                                </td>
                                                            </tr>  
    <?php
}
?>
                                                    </tbody>
                                                </table>
                                            </div> <!-- /.table-responsive -->
                                            <br/>


                                        </div> <!-- /.portlet-content -->

                                    </div> <!-- /.portlet -->


                                </div> <!-- /.col-md-4 -->



                                <div class="col-md-6">

                                    <div class="portlet">

                                        <div class="portlet-header">

                                            <h3>
                                                <i class="fa fa-group"></i>
                                                Recent Signups
                                            </h3>

                                            <ul class="portlet-tools pull-right">
                                                <li>
                                                    <button class="btn btn-sm btn-default">
                                                        <a href="index.php?page=list_users"> ALL USERS</a>
                                                    </button>
                                                </li>
                                            </ul>

                                        </div> <!-- /.portlet-header -->

                                        <div class="portlet-content">


                                            <div class="table-responsive">

                                                <table id="user-signups" class="table table-striped table-checkable"> 
                                                    <thead> 
                                                        <tr> 
                                                            <th class="checkbox-column"> 
                                                                <input type="checkbox" id="check-all" class="icheck-input" />
                                                            </th> 
                                                            <th class="hidden-xs">First Name
                                                            </th> 
                                                            <th>Last Name</th> 
                                                            <th>Status
                                                            </th> 

                                                        </tr> 
                                                    </thead> 

                                                    <tbody> 
<?php
$recent_users = DB::getInstance()->query("SELECT * FROM jerm_users  ORDER BY User_Id DESC LIMIT 10");
foreach ($recent_users->results() as $recent_users) {
    ?>
                                                            <tr class=""> 
                                                                <td class="checkbox-column"> 
                                                                    <input type="checkbox" name="actiony" value="joey" class="icheck-input"> 
                                                                </td> 

                                                                <td class="hidden-xs"><?php echo $recent_users->First_Name; ?></td> 
                                                                <td><?php echo $recent_users->Last_Name; ?></td> 
                                                                <td><span class="label label-success">Approved</span></td> 
                                                            </tr> 
<?php } ?>
                                                    </tbody> 
                                                </table>


                                            </div> <!-- /.table-responsive -->

                                        </div> <!-- /.portlet-content -->

                                    </div> <!-- /.portlet -->

                                </div> <!-- /.col-md-4 -->


                            </div> <!-- /.row -->

                           

                        </div> <!-- /.col-md-9 -->




                    </div> <!-- /.row -->

                </div> <!-- /#content-container -->


            </div> <!-- #content -->	

        </div> <!-- #wrapper -->

<?php
include 'includes/footer.php';
?>

        <script src="js/libs/jquery-1.9.1.min.js"></script>
        <script src="js/libs/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="js/libs/bootstrap.min.js"></script>

        <script src="js/plugins/icheck/jquery.icheck.min.js"></script>
        <script src="js/plugins/select2/select2.js"></script>
        <script src="js/plugins/tableCheckable/jquery.tableCheckable.js"></script>

        <script src="js/App.js"></script>

        <script src="js/libs/raphael-2.1.2.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>

        <script src="js/demos/charts/morris/area.js"></script>
        <script src="js/demos/charts/morris/donut.js"></script>

        <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

        <script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="js/demos/calendar.js"></script>

        <script src="js/demos/dashboard.js"></script>

    </body>
</html>