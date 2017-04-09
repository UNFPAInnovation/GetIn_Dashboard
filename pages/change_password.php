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

            <?php include 'includes/headerone.php'; 
            ?>


            <div id="sidebar-wrapper" class="collapse sidebar-collapse">



                <?php
                include 'includes/navigation.php';
                ?>

            </div> <!-- /#sidebar-wrapper -->



            <div id="content">		

                <div id="content-header">
                    <h1>Change Password</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-lock"></i>
                                Change Password
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">

                            <form action="#" method="post">
                                <?php
                                if (Input::exists()) {
                                    // echo Input::get('username');
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'old_pass' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        ),
                                        'new_pass' => array(
                                            'required' => TRUE
                                        )
                                        ,
                                        'confirm_new_pass' => array(
                                            'required' => TRUE
                                        )
                                    ));
                                    if ($validation->passed()) {
                                        //login user
                                        $old_pass = Input::get('old_pass');
                                        $old_pass = sha1($old_pass);
                                        $new_pass = Input::get('new_pass');
                                        $confirm_new_pass = Input::get('confirm_new_pass');
                                        $queryDup = "select * from auth_user where password='$old_pass' and id=" . $_SESSION['getin_user_id'];

                                        if (DB::getInstance()->checkRows($queryDup)) {

                                            if ($new_pass === $confirm_new_pass) {
                                                $fields=array('password'=>sha1($new_pass));
                                                $where=" id";
                                                $change_password=DB::getInstance()->update('auth_user',$_SESSION['getin_user_id'] , $fields,$where);
                                            }else{
                                                echo "<font color='red'>New Password and Confirm Password Dont Match.</font>";
                                            }
                                        }else{
                                             echo "<font color='red'>Old Password doesnt match</font>";
                                             exit();
                                        }
                                       
                                        if ($change_password) {
                                            echo "<h5 align='center' ><strong><font color='green' size='2px'>Password Changed Successfully</font></strong></h5>";
                                            header("refresh:1;url=index.php?page=change_password");
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
                                            <label for="old-pass">Old Password</label>
                                            <input type="password" id="firstname-input"  name="old_pass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="new-pass">New Password</label>
                                            <input type="password" id="lastname-input"  name="new_pass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password">Confirm New Password</label>
                                            <input type="password" id="email-input" name="confirm_new_pass" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-success fa fa-lock"> Change Password</button>

                                    </div> <!-- /.col -->


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
