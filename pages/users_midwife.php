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
                    $district = Session::getActiveDistrict();
                    $subcounty = null;
                ?>
                <div id="content-header">
                    <h1>Users</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <a href="index.php?page=list_users"><label class="label label-success">View Users</label></a><br/><p></p>
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-group"></i>
                                New Midwife
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">

                            <form action="#" method="post" name="userform">
                                <?php
                               //echo "This is the UUID:".$uuid;
                                if (Input::exists()) {
                                    // echo Input::get('username');
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'username' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        ),
                                        'password' => array(
                                            'required' => TRUE
                                        )
                                        ,
                                        'email' => array(
                                            'required' => TRUE
                                        )
                                        ,
                                        'firstname' => array(
                                            'required' => TRUE
                                        )
                                        ,
                                        'lastname' => array(
                                            'required' => TRUE
                                        )
                                        ,
                                        'phone_number' => array(
                                            'required' => TRUE
                                        )
                                    ));
                                    $fname = Input::get('firstname');
                                    $lname = Input::get('lastname');
                                    $username = Input::get('username');
                                    $password = Input::get('password');
                                    $cpassword = Input::get('cpassword');
                                    $email = Input::get('email');
                                    $role = Input::get('role');
                                    $district_id = Input::get('district_id');
                                    $phone_number = Input::get('phone_number');
                                    $subcounty = Input::get('subcounty_id');
                                    $_raw = Input::get('parish_id');
                                    $parish_id = (isset($_raw))? explode(",",$_raw): array();
                                    $parish_ids=implode(",", $parish_id);
                                    $_raw = Input::get('location_id');
                                    $location_id = (isset($_raw))? explode(",",$_raw): array();
                                    $location_ids= implode(",", $location_id);
                                        
                                    if ($validation->passed()) {
                                        //login user
                                        $fname = Input::get('firstname');
                                        $lname = Input::get('lastname');
                                        $username = Input::get('username');
                                        $password = Input::get('password');
                                        $cpassword = Input::get('cpassword');
                                        $email = Input::get('email');
                                        $role = Input::get('role');
                                        $district_id = Input::get('district_id');
                                        $subcounty = Input::get('subcounty_id');
                                        /*
                                        $parish_id = explode(",", Input::get('parish_id'));
                                        $parish_ids=  (isset($parish_id) && !empty($parish_id))? implode(",", $parish_id): "";
                                        //$_raw = Input::get('location_id');
                                        //$_ids = (isset($_raw))?Input::get('location_id):array();
                                        $location_id = explode(",", Input::get('location_id'));
                                        $location_ids= implode(",", $location_id);
                                        */
                                        
                                        $_raw = Input::get('parish_id');
                                        $parish_id = (isset($_raw))? explode(",",$_raw): array();
                                        $parish_ids=implode(",", $parish_id);
                                        $_raw = Input::get('location_id');
                                        $location_id = (isset($_raw))? explode(",",$_raw): array();
                                        $location_ids= implode(",", $location_id);
                                        $phone_number = Input::get('phone_number');
                                        $is_active = 1;
                                        $date_joined = date('Y-m-d');
                                        $queryDup = "select * from auth_user where username='$username'";
                                        if (DB::getInstance()->checkRows($queryDup)):
                                            echo "<h5 align='center' ><font color='red'>User Already Registered.</font></h5>";
                                            header("refresh:1;url=index.php?page=users");
                                            exit();                        
                                        endif;
                                        
                                        //echo "These are IDS".$location_ids;
                                        /*
                                         * send and receive values from python
                                         */
                                        
                                        $create_user_python=  exec("python user.py '-1' '$username' '$password' '$fname' '$lname' '$email'");
                                        $user_id=$create_user_python;
                                       // echo $create_user_python;
                                        if (is_numeric($create_user_python)) {
                                            /*
                                             * create observer from python
                                             */
                                            $create_observer_python=  exec("python midwife.py '$user_id' '-1' '$phone_number' '$district->id' '$subcounty'");
                                            if(is_numeric($create_observer_python)){
                                                echo "<h5 align='center' ><strong><font color='green' size='2px'>User Created</font></strong></h5>";
                                                // TODO send SMS with credentials
                                                $message = "Welcome to GetIN! Your login credentials are:\n".$username."\n".$password;
                                                $sms = new \GetINSMS(); //init sms class
                                                $response = $sms->sendToNumber($phone, $message);
                                                if($response){
                                                    redirect("User Registered Successfully. Credentials sent!", "index.php?page=users");
                                                } else {
                                                    redirect("User Registered Successfully. Unable to send credentials!", "index.php?page=users");
                                                }
                                            }else{
                                               
                                            }
                                        }
                                    } else {
                                        //output errors
                                        foreach ($validation->errors() as $error) {
                                            echo "<h5 align='center' ><font color='red'>" . $error . '</font></h5>';
                                        }
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="first-name">First Name</label>
                                            <input type="text" id="firstname-input" value="<?php echo escape(Input::get('firstname')); ?>" name="firstname" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="last-name">Last Name</label>
                                            <input type="text" id="lastname-input" value="<?php echo escape(Input::get('lastname')); ?>" name="lastname" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" id="email-input" value="<?php echo escape(Input::get('email')); ?>" name="email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">User Name</label>
                                            <input type="text" id="username-input" name="username" value="<?php echo escape(Input::get('username')); ?>" class="form-control">
                                        </div>
                                    <!--
                                    </div> 

                                    <div class="col-sm-5">
                                    -->
                                        <div class="form-group" style="display:none">	
                                            <label for="select-role">Role</label>
                                            <input type="text" name="role" id="role-input" class="form-control" value="midwife"/>
                                            <!--
                                            <select id="select-input" name="role" class="form-control">
                                                <option value="">----SELECT----</option>
                                                <option value="vht">CHEW</option>
                                                <option value="midwife">MidWife</option>
                                                <option value="dho">DHO</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                            -->
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"  name="password" id="password-input" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password</label>
                                            <input type="password" name="cpassword" id="cpassword-input" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone-number">Phone</label>
                                            <input type="number" name="phone_number" id="phone-input" class="form-control">
                                        </div>
                                        <div class="form-group" id="district_select_div" style="display:none">
                                            <label for="district_id">District</label>
                                            <input name="district_id" id="id_district" value=<?php echo("\"$district->id\""); ?> />
                                        </div>
                                        <div class="form-group" id="subcounty_select_div">
                                            <label for="patient-group">Subcounty</label>
                                            <select type="text" name="subcounty_id" class="form-control">
                                                <?php
                                                    $selected_subcounty = Input::get('subcounty_id');
                                                    if(!empty($district->id)){
                                                      $where = "district_id=$district->id";
                                                      if(!empty($selected_subcounty)){
                                                        echo DB::getInstance()->dropDownWithWhereAndSelectedRaw('core_subcounty','id','name', $where, $selected_subcounty);
                                                      } else {
                                                        echo DB::getInstance()->dropDownWithWhereRaw('core_subcounty','id','name', $where);
                                                      }    
                                                    }else{
                                                      echo DB::getInstance()->dropDowns('core_subcounty','id','name');
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    <!-- /.col -->
                                    <div class="col-sm-1"></div>

                                </div> <!-- /.row -->
                                <div class="row"> <!-- /.row -->
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-success fa fa-user"> Add User</button>
                                    </div>
                                    <div class="col-sm-5"></div>
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
