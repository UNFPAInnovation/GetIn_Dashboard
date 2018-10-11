<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title> VHT </title>
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
                    $district = Session::getActiveDistrict();
                ?>
                <div id="content-header">
                    <h1>CHEW</h1>
                </div> <!-- #content-header -->	

                <div id="content-container">
                    <a href="index.php?page=users"><label class="label label-success">Add Users</label></a><br/><p></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet">
                                <div class="portlet-header">
                                    <h3>
                                        <i class="fa fa-list"></i>
                                        Active CHEW List
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
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Full Name</th>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">User Name</th>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Email</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">Phone</th>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Role</th>
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">Last Login</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = DB::getInstance()->query("SELECT co.*,au.* FROM core_observer co,auth_user au where au.id=co.user_id and co.role='vht' and co.district_id=".$district->id);
                                                $i = 1;
                                                foreach ($query->results() as $result) {
                                                    ?>
                                                    <tr>
                                                        <td class="checkbox-column">
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td><?php echo $result->first_name . " " . $result->last_name; ?></td>
                                                        <td><?php echo $result->username; ?></td>
                                                        <td><?php echo $result->email; ?></td>
                                                        <td><?php echo $result->phone_number; ?></td>
                                                        <td><?php echo roleToViewStr($result->role); ?></td>
                                                        <td><?php echo $result->last_login; ?></td>
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
        include 'includes/footer.php';        
        include 'includes/footerjs.php';
        include 'includes/datatablejs.php';
        include 'includes/appjs.php';
        ?>

    </body>
</html>