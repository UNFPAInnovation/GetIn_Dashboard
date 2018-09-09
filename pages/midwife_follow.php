<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>Midwife Followup</title>
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
                    <h1>Midwife Follow up</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">

                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        Midwife Follow up
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

                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Patient Full Name</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">Action Date</th>
                                                    <th data-filterable="true" data-sortable="true">Ambulance Need</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Ambulance Response</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Notes</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Midwife Incharge</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $midwife = DB::getInstance()->query("select cb.*,ce.*,co.*,cs.*,cp.* from core_observer cb, core_observation co, core_subject cs, core_encounter ce,core_patients cp where cb.uuid=ce.observer_id and co.encounter_id=ce.uuid and cs.uuid=ce.subject_id and cp.subject_ptr_id=cs.id and cb.role='midwife' and cb.district_id=".$district_id." group by cs.uuid");
                                                foreach ($midwife->results() as $midwife) {
                                                    ?>
                                                    <tr>
                                                        <td class="hidden-xs hidden-sm"><?php echo $midwife->given_name . " " . $midwife->family_name; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo streamline_date($midwife->created); ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $midwife->ambulance_need; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $midwife->ambulance_response; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $midwife->value_text; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo "<strong>Name:</strong> ".DB::getInstance()->getName("auth_user",$midwife->user_id,"first_name","id")."  ".DB::getInstance()->getName("auth_user",$midwife->user_id,"last_name","id")."<br/> <strong> Phone: </strong>".$midwife->phone_number; ?></td>
                                                    </tr>  
                                                    <?php
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