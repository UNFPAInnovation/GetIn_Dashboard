<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>Girl Demographics</title>
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
                    <h1>Demographics</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">
                                <img src="img/excel.png" alt="excel"/> <a href="index.php?page=download_excel" target="_blank"><label class="label label-success">Download Excel</label></a>
                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        List Mapped Girl Demographics
                                    </h3>

                                </div> <!-- /.portlet-header -->

                                <div class="portlet-content">						
                                        <?php
                                            $get_id = Input::get("grp");
                                            $select_voucher = Input::get("vgrp");
                                            if(!isset($select_voucher)){
                                                $select_voucher = "";
                                            }
                                            $voucher_query = "";
                                            $select = "";
                                            $select1 = $_POST['vgrp'];
                                            switch ($select_voucher) {
                                                case '-1':
                                                  $voucher_query = " WHERE system_id != ''";
                                                  break;
                                                case '0':
                                                  $voucher_query = "";
                                                  break;
                                                case '1':
                                                  $voucher_query = " WHERE system_id LIKE 'HBBH%'";
                                                  break;
                                                case '2':
                                                  $voucher_query = " WHERE system_id  LIKE 'FPUG%'";
                                                  break;
                                                case '3':
                                                  $voucher_query = " WHERE system_id LIKE 'SMA%'";
                                                  break;
                                                case '4':
                                                  $voucher_query = " WHERE system_id LIKE 'LKUP%'";
                                                  break;
                                              }
                                          ?>
                                          <form action="" method="post">
                                        <label for="id_grp">Age group</label>
                                        <select name="grp" id="id_grp" >
                                            <option value="0">All</option>
                                            <option value="1">15-19 years old</option>
                                            <option value="2">20-24 years old</option>
                                            <option value="3">25-30 years old</option>
                                        </select>
                                        <label for="id_grp_voucher">Voucher Program</label>
                                        <select name="grp_voucher" id="id_grp_voucher">
                                            <option value="-1">No voucher program</option>
                                            <option value="0">All voucher programs</option>
                                            <option value="1">Reproductive Health Voucher Programme (Marie Stoppes Int)</option>
                                            <option value="2">Family Planning (Marie Stoppes)</option>
                                            <option value="3">Social Marketing Activity (UHMG - Uganda Health Marketing Group)</option>
                                            <option value="4">Young People and Key Populations (Marie Stoppes)</option>
                                        </select>
                                        <input type="submit" name="submit" value="Go"/>
                                    </form>
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
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">DOB</th>
                                                    <th data-filterable="true" data-sortable="true">Phone-Girl</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Phone-Holder</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Girl Location</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">LMD</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Marital Status</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Education Level</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Voucher ID</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">EDD</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $age_query = isset($get_id)? $get_id:"";
                                                $filter_id = true;
                                                $patient_list = DB::getInstance()->query("SELECT * FROM core_patients" . $voucher_query . "");
                                                foreach ($patient_list->results() as $patient_list) {
                                                    $age = calcAge($patient_list->dob, date('Y-m-d'));
                                                    if ($get_id == 1) {
                                                        if ($age >= 15 && $age <= 19) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $patient_list->given_name . " " . $patient_list->family_name; ?></td>
                                                                <td><?php echo streamline_date($patient_list->dob); ?></td>
                                                                <td><?php echo $patient_list->pnumber; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->holder_pnumber; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->location; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo streamline_date($patient_list->lmd); ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->marital_status; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->education_level; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->system_id; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo addMonthsToDate(9, $patient_list->lmd); ?></td>
                                                                <td><form action="index.php?page=demograhics_details" method="post">
                                                                    <input name="patient_id" value="<?php echo $patient_list->subject_ptr_id; ?>" type="hidden"/>
                                                                    <button class="btn btn-xs btn-success" type="submit">View Details</button>
                                                                </form></td>
                                                            </tr>   
                                                            <?php
                                                        }
                                                    } elseif ($get_id == 2) {
                                                        if ($age >= 20 && $age <= 24) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $patient_list->given_name . " " . $patient_list->family_name; ?></td>
                                                                <td><?php echo streamline_date($patient_list->dob); ?></td>
                                                                <td><?php echo $patient_list->pnumber; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->holder_pnumber; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->location; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo streamline_date($patient_list->lmd); ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->marital_status; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->education_level; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->system_id; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo addMonthsToDate(9, $patient_list->lmd); ?></td>
                                                                <td><form action="index.php?page=demograhics_details" method="post">
                                                                    <input name="patient_id" value="<?php echo $patient_list->subject_ptr_id; ?>" type="hidden"/>
                                                                    <button class="btn btn-xs btn-success" type="submit">View Details</button>
                                                                </form></td>
                                                            </tr> 
                                                            <?php
                                                        }
                                                    } elseif ($get_id == 3) {
                                                        if ($age >= 25 && $age <= 30) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $patient_list->given_name . " " . $patient_list->family_name; ?></td>
                                                                <td><?php echo streamline_date($patient_list->dob); ?></td>
                                                                <td><?php echo $patient_list->pnumber; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->holder_pnumber; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->location; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo streamline_date($patient_list->lmd); ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->marital_status; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->education_level; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->system_id; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo addMonthsToDate(9, $patient_list->lmd); ?></td>
                                                                <td>
                                                                    <form action="index.php?page=demograhics_details" method="post">
                                                                    <input name="patient_id" value="<?php echo $patient_list->subject_ptr_id; ?>" type="hidden"/>
                                                                    <button class="btn btn-xs btn-success" type="submit">View Details</button>
                                                                </form>
                                                                </td>
                                                            </tr> 
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $patient_list->given_name . " " . $patient_list->family_name; ?></td>
                                                            <td><?php echo streamline_date($patient_list->dob); ?></td>
                                                            <td><?php echo $patient_list->pnumber; ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo $patient_list->holder_pnumber; ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo $patient_list->location; ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo streamline_date($patient_list->lmd); ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo $patient_list->marital_status; ?></td>
                                                                <td class="hidden-xs hidden-sm"><?php echo $patient_list->education_level; ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo $patient_list->system_id; ?></td>
                                                            <td class="hidden-xs hidden-sm"><?php echo addMonthsToDate(9, $patient_list->lmd); ?></td>
                                                            <td><form action="index.php?page=demograhics_details" method="post">
                                                                    <input name="patient_id" value="<?php echo $patient_list->subject_ptr_id; ?>" type="hidden"/>
                                                                    <button class="btn btn-xs btn-success" type="submit">View Details</button>
                                                                </form></td>
                                                        </tr> 
                                                        <?php
                                                    }
                                                    ?>

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