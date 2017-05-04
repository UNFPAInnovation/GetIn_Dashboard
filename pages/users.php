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
                    <h1>Users</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <a href="index.php?page=list_users"><label class="label label-success">View Users</label></a><br/><p></p>
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-group"></i>
                                New User
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">

                            <form action="#" method="post">
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
                                    if ($validation->passed()) {
                                        //login user
                                        $fname = Input::get('firstname');
                                        $lname = Input::get('lastname');
                                        $username = Input::get('username');
                                        $password = Input::get('password');
                                        $cpassword = Input::get('cpassword');
                                        $email = Input::get('email');
                                        $role = Input::get('role');
                                        $phone_number = Input::get('phone_number');
                                        $is_active = 1;
                                        $date_joined = date('Y-m-d');
                                        $queryDup = "select * from auth_user where username='$username'";
                                        if (DB::getInstance()->checkRows($queryDup)):
                                            echo "<h5 align='center' ><font color='red'>User Already Registered.</font></h5>";
                                            header("refresh:1;url=index.php?page=users");
                                            exit();
//                                            
                                        endif;
                                        /*
                                         * send and receive values from python
                                         */
                                        $uuid=`makeuuid.py`;
                                        $send_pwd_python=  exec("python makepassword.py .$password");
                                        $userInsert = DB::getInstance()->insert('auth_user', array(
                                            'username' => $username,
                                            'u_role' => $role,
                                            'password' => $send_pwd_python,
                                            'first_name' => $fname,
                                            'last_name' => $lname,
                                            'email' => $email,
                                            'is_active' => $is_active,
                                            'date_joined' => $date_joined
                                        ));
                                        if ($userInsert) {
                                            $last_insert_id = DB::getInstance()->previous_id();
                                            DB::getInstance()->insert('core_observer', array(
                                                'uuid' => $uuid,
                                                'user_id' => $last_insert_id,
                                                'role' => $role,
                                                'phone_number'=>$phone_number
                                            ));
                                            echo "<h5 align='center' ><strong><font color='green' size='2px'>User Created</font></strong></h5>";
                                            header("refresh:2;url=index.php?page=users");
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
                                    <div class="col-sm-5">

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
                                        <button type="submit" class="btn btn-success fa fa-user"> Add User</button>

                                    </div> <!-- /.col -->

                                    <div class="col-sm-5">
                                        <div class="form-group">	
                                            <label for="select-role">Role</label>
                                            <select id="select-input" name="role" class="form-control">
                                                <option value="vht">VHT</option>
                                                <option value="midwife">MidWife</option>
                                                <option value="dho">DHO</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"  name="password" id="password-input" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password</label>
                                            <input type="password" name="cpassword" id="username-input" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone-number">Phone</label>
                                            <input type="number" name="phone_number" placeholder="eg: 2567XX123456" id="phone-input" class="form-control">
                                        </div>


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
