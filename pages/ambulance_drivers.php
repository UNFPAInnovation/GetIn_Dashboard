<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title> Ambulance Drivers </title>
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
                    <h1>Ambulance Drivers</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">
                    <a href="index.php?page=new_driver"><label class="label label-success">New Driver</label></a><br/><p></p>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">

                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        List of all ambulance drivers
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
                                                       #
                                                    </th>
                    
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc" class="hidden-xs hidden-sm"/>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Last Name</th>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">First Name</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">Phone</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">Operational Subcounty</th>
                                                    <th/>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i=1;
                                                $district_id = $_SESSION['getin_district'];
                                                $ambulance_drivers = NULL;
                                                // Safety check on the district id. Shouldn't ever happen.
                                                if(!empty($district_id)){
                                                    $ambulance_drivers = DB::getInstance()->query("SELECT ca.*, cs.name AS subcounty FROM core_ambulancedriver ca, core_subcounty cs WHERE ca.subcounty_id=cs.id AND cs.district_id=$district_id ORDER BY cs.name ASC");
                                                }
                                                // Set results to empty array if db not queried
                                                $drivers = (!empty($ambulance_drivers))? $ambulance_drivers->results(): [];
                                                foreach ($drivers as $driver) {
                                                    ?>
                                                    <tr>
                                                        <td class="checkbox-column">
                                                            <input type="checkbox" class="icheck-input"/>
                                                        </td>
                                                        <td class="hidden-xs hidden-sm"> 
                                                            <?php echo $driver->id; ?>
                                                        </td>
                                                        <td><?php echo $driver->last_name;  ?></td>
                                                        <td><?php echo $driver->first_name; ?></td>
                                                        <td><?php echo $driver->phone_number;  ?></td>
                                                        <td><?php echo $driver->subcounty;  ?></td>
                                                        <td>
                                                            <button id=<?php echo "\"".$driver->id."\""?> onClick=<?php echo "\"(function(){window.location='./index.php?page=new_driver&id=".$driver->id."'})()\""; ?> class="btn btn-success fa fa-user btn-edit">Edit</button>
                                                        </td>
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

                        </div> <!-- /.col -->

                    </div> <!-- /.row -->

                </div> <!-- /#content-container -->

            </div> <!-- #content -->

        </div> <!-- #wrapper -->

        <?php
        include 'includes/footer.php';;
        include 'includes/footerjs.php';
        include 'includes/datatablejs.php';
        include 'includes/appjs.php';
        ?>            
    </body>
</html>