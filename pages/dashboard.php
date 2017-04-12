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

                            <a href="javascript:;" class="dashboard-stat tertiary">
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

                            <a href="javascript:;" class="dashboard-stat tertiary">
                                <div class="visual">
                                    <i class="fa fa-star"></i>
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
                                    <i class="fa fa-star"></i>
                                </div> <!-- /.visual -->

                                <div class="details">
                                    <span class="content">Registered Users</span>
                                    <span class="value"><?php
                                        echo DB::getInstance()->returnCount("SELECT * FROM auth_user");
                                        ?></span>
                                </div> <!-- /.details -->

                                <i class="fa fa-play-circle more"></i>

                            </a> <!-- /.dashboard-stat -->

                        </div> <!-- /.col-md-3 -->

                        <div class="col-md-3 col-sm-6">

                            <a href="javascript:;" class="dashboard-stat tertiary">
                                <div class="visual">
                                    <i class="fa fa-star"></i>
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
                                            <td width="30%">
                                                (15-19) Years:     <br/><p></p>
                                                (20-24) Years:     <br/><p></p>
                                                (25-30) Years:     <br/><p></p>
                                            </td>
                                            <td width="30%">
                                                <strong><?php echo $group1; ?> Girls  </strong>  <br/><p></p>
                                                <strong><?php echo $group2; ?> Girls </strong>  <br/><p></p>
                                                <strong><?php echo $group3; ?> Girls </strong>  <br/><p></p>
                                            </td>
                                            <td>
                                                <a href="index.php?page=demographics&grp=1"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=demographics&grp=2"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=demographics&grp=3"><label class="label label-success">Details</label></a><br/><p></p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th data-direction="asc" data-filterable="true" data-sortable="true">Mapped Girls</th>
                                            <td>Mapped Girl </td>
                                            <td><strong><?php echo $mother_counter; ?></strong></td>
                                            <td> <a href="index.php?page=demographics"><label class="label label-success">Details</label></a></td>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true" width="40%">Personnel</th>
                                            <td width="30%">
                                                VHT:           <br/><p></p>
                                                Mid Wives:     <br/><p></p>
                                                Drivers:       <br/><p></p>
                                            </td>
                                            <td width="30%">
                                                <strong><?php echo DB::getInstance()->returnCount("SELECT co.*,au.* FROM core_observer co,auth_user au where au.id=co.user_id and co.role='vht'"); ?></strong><br/><p></p>
                                                <strong><?php echo DB::getInstance()->returnCount("SELECT co.*,au.* FROM core_observer co,auth_user au where au.id=co.user_id and co.role='midwife'"); ?></strong><br/><p></p>
                                                <strong><?php echo DB::getInstance()->returnCount("select * from core_ambulancedriver"); ?></strong> <br/><p></p>
                                            </td>
                                            <td>
                                                <a href="index.php?page=vht_count"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=midwives_count"> <label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=ambulance_drivers"><label class="label label-success">Details</label></a><br/><p></p>
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
                                            <th data-sortable="true" width="60%">Visits</th>
                                            <td width="25%">Scheduled Visits   <br/><p></p>
                                                Visited Today:    <br/><p></p>
                                                Missed Visit:    <br/><p></p>
                                                Expected Today:    <br/><p></p>
                                            </td>
                                            <td width="20%">
                                                <strong> <?php echo DB::getInstance()->returnCount("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id"); ?><br/><p></p>
                                                    <?php echo DB::getInstance()->returnCount("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id and tt.due_on='$date_due_on'"); ?><br/><p></p>
                                                    <?php echo DB::getInstance()->returnCount("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id and tt.due_on>'$date_due_on'"); ?><br/><p></p>
                                                    <?php echo DB::getInstance()->returnCount("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id and tt.due_on='$date_due_on'"); ?><br/><p></p>


                                                </strong>
                                            </td>
                                            <td>
                                                <a href="index.php?page=scheduled_appointments"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=attended_today"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=missed_attendance"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=expected_visits"><label class="label label-success">Details</label></a><br/><p></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $cug = DB::getInstance()->query("SELECT * FROM core_patients");
                                            $mtn = 0;
                                            $airtel = 0;
                                            $pending = 0;
                                            foreach ($cug->results() as $cug) {
                                                $phone1 = str_split($cug->pnumber);
                                                $phone2 = str_split($cug->holder_pnumber);

                                                $pattern1 = $phone1[0] . "" . $phone1[1] . "" . $phone1[2];
                                                $pattern2 = $phone2[0] . "" . $phone2[1] . "" . $phone2[2];
                                                if ($pattern1 == '078' || $pattern1 == '077' || $pattern1 == '075' || $pattern1 == '070') {

                                                    if ($pattern1 == '078' || $pattern1 == '077'):
                                                        $mtn++;
                                                    elseif ($pattern1 == '075' || $pattern1 == '070'):
                                                        $airtel++;
                                                    endif;


                                                    if ($pattern2 == '075' || $pattern2 == '070'):
                                                        $airtel++;
                                                    elseif ($pattern2 == '078' || $pattern2 == '077'):
                                                        $mtn++;
                                                    endif;
                                                }
                                                else {
                                                    $pending++;
                                                }
                                            }
                                            ?>
                                            <th data-sortable="true" width="40%">User Groups</th>
                                            <td width="25%">MTN:    <br/><p></p>
                                                Airtel:     <br/><p></p>
                                                Pending:     <br/><p></p>
                                            </td>
                                            <td width="20">
                                                <strong> <?php echo $mtn; ?>  <br/><p></p>
                                                    <?php echo $airtel; ?><br/><p></p>
                                                    <?php echo $pending; ?><br/><p></p></strong></td>
                                            <td width="20%">
                                                <a href="index.php?page=cug&grp=1"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=cug&grp=2"><label class="label label-success">Details</label></a><br/><p></p>
                                                <a href="index.php?page=cug"><label class="label label-success">Details</label></a><br/><p></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th data-sortable="true" width="60%">Composed Broad Cast Messages</th>
                                            <td width="25%"> 
                                                Messages
                                            </td>
                                            <td width="20%">
                                                <strong><?php echo DB::getInstance()->returnCount("select * from messages"); ?></strong>
                                            </td>
                                            <td>
                                                <a href="#"><label class="label label-success">Details</label></a>
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
                                                Recent Mapped Girls
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
                                                            <th>Girl Names</th>
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
                                                                #
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
                                                        $recent_users = DB::getInstance()->query("SELECT * FROM auth_user  ORDER BY id DESC LIMIT 10");
                                                        $i = 1;
                                                        foreach ($recent_users->results() as $recent_users) {
                                                            ?>
                                                            <tr class=""> 
                                                                <td class="checkbox-column"> 
                                                                    <?php echo $i; ?>
                                                                </td> 

                                                                <td class="hidden-xs"><?php echo $recent_users->first_name; ?></td> 
                                                                <td><?php echo $recent_users->last_name; ?></td> 
                                                                <td><span class="label label-success">Approved</span></td> 
                                                            </tr> 
                                                            <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody> 
                                                </table>


                                            </div> <!-- /.table-responsive -->

                                        </div> <!-- /.portlet-content -->

                                    </div> <!-- /.portlet -->

                                </div> <!-- /.col-md-4 -->


                            </div> <!-- /.row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <table border="1">
                                        <tr>
                                            <td>
                                                <?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
                                                include "fusioncharts.php";
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
                                                $columnChart = new FusionCharts("column2d", "ex1", "100%", 400, "chart-1", "json", '{  
                "chart":{  
                  "caption":"Harry\'s SuperMart",
                  "subCaption":"Top 5 stores in last month by revenue",
                  "numberPrefix":"$",
                  "theme":"ocean"
                },
                "data":[  
                  {  
                     "label":"Bakersfield Central",
                     "value":"880000"
                  },
                  {  
                     "label":"Garden Groove harbour",
                     "value":"730000"
                  },
                  {  
                     "label":"Los Angeles Topanga",
                     "value":"590000"
                  },
                  {  
                     "label":"Compton-Rancho Dom",
                     "value":"520000"
                  },
                  {  
                     "label":"Daly City Serramonte",
                     "value":"330000"
                  }
                ]
            }');
// Render the chart
                                                $columnChart->render();
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>



                            </div>

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