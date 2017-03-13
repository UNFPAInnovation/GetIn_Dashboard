<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>Jerm Orders</title>
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
                    <h1>Completed Orders</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">

                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        List Completed Orders
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
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Purchase Date</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">Number of Items Bought</th>
                                                    <th data-filterable="true" data-sortable="true">Received Amount</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Status</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Payment Method</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $recent_orders = DB::getInstance()->query("SELECT * FROM jerm_orders WHERE Status='Completed' GROUP BY Order_Number");
                                                foreach ($recent_orders->results() as $recent_orders) {
                                                    $items = DB::getInstance()->trackOrdersQty($recent_orders->Order_Number);
                                                    ?>
                                                    <tr>
                                                        <td class="checkbox-column">
                                                            <input type="checkbox" class="icheck-input">
                                                        </td>
                                                        <td><?php echo format_date($recent_orders->Date); ?></td>
                                                        <td><?php echo $items; ?>
                                                        </td>
                                                        <td> <span class="label label-success"><strong><?php echo ugandan_shillings(DB::getInstance()->trackOrdersPrice($recent_orders->Order_Number)); ?></strong></span></td>
                                                        <td class="hidden-xs hidden-sm"><span class="label label-success"><?php echo $recent_orders->Status; ?></span></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $recent_orders->Payment_Method;  ?> </td>
                                                        <td class="hidden-xs hidden-sm"> 
                                                            <form action="index.php?page=<?php echo $crypt->encode('order_summary'); ?>" method="post">
                                                                <input name="order_track" value="<?php echo $recent_orders->Order_Number; ?>" type="hidden"/>
                                                                <input name="date" value="<?php echo $recent_orders->Date; ?>" type="hidden"/>
                                                                <input name="checker" value="Ok" type="hidden" />
                                                                <input name="shipping_id" value="<?php echo $recent_orders->Shipping_Id; ?>" type="hidden"/>
                                                                <input name="user_id" value="<?php echo $recent_orders->User_Id; ?>" type="hidden"/>
                                                                <button class="btn btn-xs btn-success">View</button>
                                                            </form></td>
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
</html><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

