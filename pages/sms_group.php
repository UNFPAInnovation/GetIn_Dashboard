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
                    $district = DB::getInstance()->getName('core_district', $district_id, 'name', 'id');
                ?>
                <div id="content-header">
                    <h1>Instant Messaging</h1>
                </div> <!-- #content-header -->


                <div id="content-container">
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-envelope"></i>
                                Send to An SMS to a Group
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">
                            <form action="#" method="post">
                                <?php
                                if (isset($_POST['send_message'])) {
                                    // echo Input::get('username');
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'group' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        )
                                    ));
                                    if ($validation->passed()) {
                                        //login user
                                        $store_numbers = array();
                                        $group = Input::get('group');
                                        $message = Input::get('message');
                                        //changed query to only return phone numbers
                                        $return_numbers = DB::getInstance()->query("select phone_number from core_observer where role='$group' and district_id=$district_id");
                                        foreach ($return_numbers->results() as $return_numbers) {
                                            array_push($store_numbers, $return_numbers->phone_number);
                                        }
                                        $numbers = implode(",+", $store_numbers);
                                        //$numbers = "256753601781,+256773971147,+256750333668";
                                        //send SMSes
                                        $sms = new \GetINSMS(); //init sms class
                                        $response = $sms->sendToMany($numbers, $message);
                                        if ($response) {
                                            redirect("Message Sent", "index.php?page=sms_group");
                                        }
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="select-role">Group</label>
                                            <select id="select-input" name="group" class="form-control">
                                                <option value="vht">CHEW</option>
                                                <option value="midwife">MidWife</option>
                                                <option value="1">1st Trimester</option>
                                                <option value="2">2nd Trimester</option>
                                                <option value="3">3rd Trimester</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message (130 Characters Only)</label>
                                            <textarea type="text" id="username-input" name="message" class="form-control">
                                                <?php echo escape(Input::get('message')); ?>
                                            </textarea>
                                        </div>
                                        <button type="submit" name="send_message" class="btn btn-success fa fa-envelope"> Send Message</button>

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
