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
                                        <label class="label label-success"><a href=""><font color="white">1. 4th ANC Visits</font></a></label>
                                        <br/><p></p>
                                        <label class="label label-success"><a href=""><font color="white">2. Girls due to deliver during the project life with the assistance of skilled attendance.</font></a></label>
                                        <br/><p></p>
                                        <label class="label label-success"><a href=""><font color="white">3. Number of calls made for ambulance pickups</font></a></label>
                                        <br/><p></p>
                                        <label class="label label-success"><a href=""><font color="white">4. Family planning - Number of girls due for postpartum family planning and have started on family planning.</font></a></label>
                                        <br/>


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
