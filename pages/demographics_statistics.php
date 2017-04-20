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
                    <h1>Statistical Analysis</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <!--<a href="index.php?page=list_users"><label class="label label-success">View Users</label></a><br/><p></p>-->
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-group"></i>
                                Statistical Analysis
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">

                            <form action="#" method="post">

                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                        <table width="100%" border="1">
                                            <tr>
                                                <td><strong>Marital Status</strong></td>

                                                <td><?php
                                                    $marital_status = DB::getInstance()->query("SELECT marital_status ,count(marital_status) as number FROM core_patients group by marital_status");
                                                    foreach ($marital_status->results() as $marital_status) {
                                                        echo $marital_status->marital_status."     <strong>".$marital_status->number."</strong><br/>"; 
                                                    }
                                                    ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><strong>Education Level</strong></td>

                                                <td><?php
                                                    $education_level = DB::getInstance()->query("SELECT education_level ,count(education_level) as number FROM core_patients group by education_level");
                                                    foreach ($education_level->results() as $education_level) {
                                                        echo $education_level->education_level."     <strong>".$education_level->number."</strong><br/>"; 
                                                    }
                                                    ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td><strong>Contraceptive Use</strong></td>

                                                <td><?php
                                                    $contraceptive_use = DB::getInstance()->query("SELECT contraceptive_use ,count(contraceptive_use) as number FROM core_patients group by contraceptive_use");
                                                    foreach ($contraceptive_use->results() as $contraceptive_use) {
                                                        echo $contraceptive_use->contraceptive_use."     <strong>".$contraceptive_use->number."</strong><br/>"; 
                                                    }
                                                    ?></td>
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
        ?>

        <script src="./js/libs/jquery-1.9.1.min.js"></script>
        <script src="./js/libs/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="./js/libs/bootstrap.min.js"></script>

        <script src="./js/App.js"></script>

    </body>
</html>
