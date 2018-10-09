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
                <?php
                    $district_id = $_SESSION['getin_district'];
                ?>
                <div id="content-header">
                    <h1>New Ambulance Driver</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <a href="index.php?page=ambulance_drivers"><label class="label label-success">View Drivers</label></a><br/><p></p>
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-envelope"></i>
                                New Driver
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">
                            <form action="#" method="post">
                                <?php
                                $id = (!empty(Input::get('id')))? intval(Input::get('id')): -1;
                                if (isset($_POST['saveDriver'])) {
                                    echo "heheheh";
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'first_name' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        ),
                                        'last_name' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        ),'phone_number' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        ),
                                        'subcounty' => array(
                                            'required' => TRUE
                                        )
                                    ));
                                    if ($validation->passed()) {
                                        //login user
                                        $firstname = Input::get('first_name');
                                        $lastname = Input::get('last_name');
                                        $phonenumber= Input::get('phone_number');
                                        $subcounty = Input::get('subcounty');
                                        //$response=send_sms($phone, $message);
                                        $insertDriver = DB::getInstance()->insert('core_ambulancedriver', array(
                                            'first_name' => $firstname,
                                            'last_name' => $lastname,
                                            'phone_number' => $phonenumber,
                                            'subcounty_id' => $subcounty,
                                            'uuid' => $uuid
                                        ));
                                        if($insertDriver){
                                            redirect("Ambulance Driver Registered Successfully", "index.php?page=new_driver");
                                        }else{
                                            redirect("Error: Not Ambulance Driver Not Registered", "index.php?page=new_driver");
                                        }
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">

                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" id="firstname-input" value="<?php echo escape(Input::get('first_name')); ?>" name="first_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" id="lastname-input" value="<?php echo escape(Input::get('last_name')); ?>" name="last_name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" id="phonenumber-input" value="<?php echo escape(Input::get('phone_number')); ?>" placeholder="Format:2567XX123456"name="phone_number" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="subcounty">Subcounty</label>
                                            <select type="text" name="subcounty" class="form-control">
                                                <?php
                                                $where = array('district_id', '=', $district_id);
                                                $rawWhere = "district_id = $district_id";
                                                echo DB::getInstance()->dropDownWithWhereRaw('core_subcounty','id','name', $rawWhere);
                                                ?>
                                            </select>
                                            <?php echo "district = $district_id" ?>
                                        </div>
                                        
                                        <button type="submit" name="saveDriver" class="btn btn-success"> Save</button>

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
        include 'includes/appjs.php';
        ?>
    </body>
</html>
