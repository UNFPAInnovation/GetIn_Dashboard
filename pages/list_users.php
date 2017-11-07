<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>

        <title>GetIn Users</title>
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
                    <h1>System Users</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">
                    <a href="index.php?page=users"><label class="label label-success">Add Users</label></a><br/><p></p>
                    <div class="row">

                        <div class="col-md-12">

                            <div class="portlet">

                                <div class="portlet-header">

                                    <h3>
                                        <i class="fa fa-list"></i>
                                        List Users
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
                                                    <th data-filterable="true" data-sortable="true" data-direction="desc">User Name</th>
                                                    <th data-direction="asc" data-filterable="true" data-sortable="true">Full Names</th>
                                                    <th data-filterable="true" data-sortable="true">Email</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Date Joined</th>
                                                    <th data-filterable="true" class="hidden-xs hidden-sm">Role</th>
                                                     <th data-filterable="true" class="hidden-xs hidden-sm">Phone</th>
                                                     <th data-filterable="true" class="hidden-xs hidden-sm">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $users_list = DB::getInstance()->query("SELECT au.*,co.* FROM auth_user au, core_observer co where co.user_id=au.id");
                                                foreach ($users_list->results() as $users_list) {
                                                    ?>
                                                    <tr>
                                                        <td class="checkbox-column">
                                                            <input type="checkbox" class="icheck-input">
                                                        </td>
                                                        <td><?php echo $users_list->username; ?></td>
                                                        <td><?php echo $users_list->first_name . " " . $users_list->last_name; ?>
                                                        </td>
                                                        <td><?php echo $users_list->email; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo plain_date($users_list->date_joined); ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $users_list->role; ?></td>
                                                        <td class="hidden-xs hidden-sm"><?php echo $users_list->phone_number; ?></td>
                                                        <td>
                                                            <button id=<?php echo "\"".$users_list->user_id."\""?> onClick="edit_click(this.id)" class="btn btn-success fa fa-user">Edit</button>
                                                        </td>
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
                    <script type="text/javascript">
                      function edit_click(clicked_id){
                          var url = "/id=" + clicked_id;
                          // Do something
                      }
                    </script>
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