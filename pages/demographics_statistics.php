<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php include 'includes/header.php'; ?>	
        <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
        <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.widgets.js"></script>
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
                                        <label class="label label-success"><a href="index.php?page=forth_anc"><font color="white">1. 4th ANC Visits</font></a></label>
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
                            <div class="row">
                                <div class="col-md-10">
                                    <table border="1">
                                        <tr>
                                            <td>
                                                <?php
// This is a simple example on how to draw a chart using FusionCharts and PHP.
// We have included includes/fusioncharts.php, which contains functions
// to help us easily embed the charts.
                                                include 'fusioncharts.php';
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
                                                $columnChart = new FusionCharts("column2d", "ex1", "100%", 400, "chart-1", "json", '{  
                "chart":{  
                  "caption":"Age groups of mapped girls",
                  "subCaption":"",
                  "numberPrefix":"",
                  "theme":"ocean"
                },
                "data":[  
                  {  
                     "label":"15-19 Years",
                     "value":"27"
                  },
                  {  
                     "label":"20-24 Years",
                     "value":"2"
                  },
                  {  
                     "label":"25-30",
                     "value":"0"
                  }
                ]
            }');
// Render the chart
                                                $columnChart->render();
                                                ?>
                                                <div class="live-chart-wrapper">
                                                    <span id="chart-1" class="chart" style="height:500px"><!-- Fusion Charts will render here--></span>

                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>



                            </div>
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
