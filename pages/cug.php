<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>Closed User Group</title>
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

                <div id="content-header">
                    <h1>Closed Used Groups</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">

                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        List of CUG
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
                                                    <th class="checkbox-column">
                                                        <input type="checkbox" class="icheck-input">
                                                    </th>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Full Name</th>
                                                    <th data-filterable="true" data-sortable="true">Phone-Girl</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Power Holder</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">CUG -Girl</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">CUG - Powerholder</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $ie=1;
                                                $get_id=  Input::get("grp");
                                                $users_list = DB::getInstance()->query("SELECT * FROM core_patients");
                                                foreach ($users_list->results() as $users_list) {
                                                    $phone1 = str_split($users_list->pnumber);
                                                    $phone2 = str_split($users_list->holder_pnumber);
                                                    $pattern1 = $phone1[0] . "" . $phone1[1] . "" . $phone1[2];
                                                    $pattern2 = $phone2[0] . "" . $phone2[1] . "" . $phone2[2];
                                                    if($pattern1 == '078' || $pattern1 == '077' || $pattern1 == '075' || $pattern1 == '070' ):
                                                    ?>
                                                    <tr>
                                                        <td class="checkbox-column">
                                                            <input type="checkbox" class="icheck-input">
                                                        </td>
                                                        <td><?php echo $users_list->given_name . " " . $users_list->family_name; ?></td>
                                                        <td><?php echo $users_list->pnumber; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $users_list->holder_pnumber; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php
                                                            if ($pattern1 == '078' || $pattern1 == '077'){
                                                                if($get_id==1 || empty($get_id)){
                                                                echo "<font color='blue'>MTN - User Group</font>";
                                                                }
                                                            }
                                                            elseif($pattern1 == '075' || $pattern1 == '070'){
                                                                if($get_id==2 || empty($get_id)){
                                                                echo "<font color='green'>Airtel - User Group</font>";
                                                                }
                                                            }
                                                            ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php
                                                            if ($pattern2 == '078' || $pattern2 == '077'){
                                                                if($get_id==2 || empty($get_id)){
                                                                echo "<font color='blue'>MTN - User Group</font>";
                                                                }
                                                            }
                                                            elseif($pattern2 == '075' || $pattern2 == '070'){
                                                                if($get_id==2 || empty($get_id)){
                                                                echo "<font color='green'>Airtel - User Group</font>";
                                                                }
                                                            }
                                                            ?></td>
                                                    </tr>  
                                                    <?php
                                                    endif;
                                                    $ie++;
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