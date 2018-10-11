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
                    <h1>Details</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <!--<a href="index.php?page=list_users"><label class="label label-success">View Users</label></a><br/><p></p>-->
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-group"></i>
                                Girl Details
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">

                            <form action="#" method="post">
                                <?php
                                $patient_id = Input::get("patient_id");
                                $query = DB::getInstance()->query("SELECT * FROM core_patients where subject_ptr_id=".$patient_id);
                                foreach ($query->results() as $result) {
                                    $patient_name=$result->given_name."  ".$result->family_name;
                                    $pnumber=$result->pnumber;
                                    $dob=$result->dob;
                                    $gender=$result->gender;
                                    $marital_status=$result->marital_status;
                                    $education_level=$result->education_level;
                                    $contraceptive_use=$result->contraceptive_use;
                                    $district=$result->district;
                                    $county=$result->county;
                                    $scounty=$result->subcounty;
                                    $parish=$result->parish;
                                    $village=$result->village;
                                    $lmd=$result->lmd;
                                    $edd=$result->edd;
                                    $holder_pnumber=$result->holder_pnumber;
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                    <table width="100%" border="1">
                                        <tr>
                                            <td>Patient Name</td>
                                            <td><?php  echo $patient_name;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Patient Number</td>
                                            <td><?php  echo $pnumber;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>DOB</td>
                                            <td><?php  echo streamline_date($dob);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?php  echo $gender;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Educational Level</td>
                                            <td><?php  echo $education_level;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Marital Status</td>
                                            <td><?php  echo $marital_status;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Contraceptive Use</td>
                                            <td><?php  echo $contraceptive_use;  ?></td>
                                        </tr>
                                    </table>

                                    </div> <!-- /.col -->

                                    <div class="col-sm-5">
                                     <table width="100%" border="1">
                                        <tr>
                                            <td>District</td>
                                            <td><?php  echo $district;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>County</td>
                                            <td><?php  echo $county;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Subcounty</td>
                                            <td><?php  echo $scounty;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Parish</td>
                                            <td><?php  echo $parish;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Village</td>
                                            <td><?php  echo $village;  ?></td>
                                        </tr>
                                        <tr>
                                            <td>LMD</td>
                                            <td><?php  echo streamline_date($lmd);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>EDD</td>
                                            <td><?php  echo streamline_date($edd);  ?></td>
                                        </tr>
                                        <tr>
                                            <td>Holder Power Number</td>
                                            <td><?php  echo $holder_pnumber;  ?></td>
                                        </tr>
                                    </table>  

                                    </div> <!-- /.col -->
                                    <div class="col-sm-1"></div>

                                </div> <!-- /.row -->

                            </form>
                        </div> <!-- /.portlet-content -->

                    </div> <!-- /.portlet -->

                </div> <!-- /#content-container -->			

            </div> <!-- #content -->


        </div> <!-- #wrapper -->

        <?php
        include 'includes/footer.php';
        include 'includes/footerjs.php';
        include 'includes/datatablejs.php';
        include 'includes/appjs.php';
        ?>

    </body>
</html>
