<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>Missed Visits</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="">
        <meta name="author" content="" />

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">
        <link rel="stylesheet" href="./css/font-awesome.min.css" type="text/css" />		
        <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" />	
        <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />			

        <link rel="stylesheet" href="./js/plugins/icheck/skins/minimal/blue.css" type="text/css" />

        <link rel="stylesheet" href="./css/App.css" type="text/css" />

        <link rel="stylesheet" href="./css/custom.css" type="text/css" />

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
                <?php
                    $district_id = $_SESSION['getin_district'];
                    $district = DB::getInstance()->getName('core_district', $district_id, 'name', 'id');
                ?>
                <div id="content-header">
                    <h1>List of all all patients who missed appointments</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">

                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        Missed Appointment
                                    </h3>

                                </div> <!-- /.portlet-header -->

                                <div class="portlet-content">						

                                    <div class="table-responsive">

                                        <table 
                                            class="table table-striped table-bordered table-hover table-highlight table-checkable" 
                                            data-provide="datatable" 
                                            data-display-rows="10"
                                            data-info="true"
                                            data-search="true"
                                            data-length-change="true"
                                            data-paginate="true"
                                            >
                                            <thead>
                                                <tr>
                                                    
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Full Name</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">Phone</th>
                                                    <th data-filterable="true" data-sortable="true">Power Holder Contact</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Village</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Date of Birth</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Status</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Appointment Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $date_today=  date('Y-m-d');
                                                $scheduled = DB::getInstance()->query("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id and cp.district LIKE '".$district."'");
                                                foreach ($scheduled->results() as $scheduled) {
                                                    $status=$scheduled->status_id;
                                                    $due_on=$scheduled->due_on;
                                                    $date_due_on_array=  explode(" ", $due_on);
                                                    $date_due_on=$date_due_on_array[0];
                                                    if($status==3){
                                                        if($date_due_on<$date_today){
                                                    ?>
                                                    <tr>
                                                        
                                                        <td><?php echo $scheduled->family_name."  ".$scheduled->given_name ?></td>
                                                        <td><?php echo $scheduled->pnumber;  ?></td>
                                                        <td><?php echo $scheduled->holder_pnumber;  ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $scheduled->village;  ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo streamline_date($scheduled->dob);  ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo descStatus($status);  ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo streamline_date_time($scheduled->due_on);  ?></td>
                                                    </tr>  
                                                    <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-responsive -->


                                </div> <!-- /.portlet-content -->

                            </div> <!-- /.portlet -->



                        </div> <!-- /.col -->

                    </div> <!-- /.row -->








                </div> <!-- /#content-container -->



            </div> <!-- #content -->


        </div> <!-- #wrapper -->

        <?php
        include 'includes/footer.php';
        ?>

        <script src="./js/libs/jquery-1.9.1.min.js"></script>
        <script src="./js/libs/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="./js/libs/bootstrap.min.js"></script>

        <script src="./js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="./js/plugins/datatables/DT_bootstrap.js"></script>
        <script src="./js/plugins/tableCheckable/jquery.tableCheckable.js"></script>

        <script src="./js/plugins/icheck/jquery.icheck.min.js"></script>

        <script src="./js/App.js"></script>


    </body>
</html>