<!DOCTYPE html>  
<head>
    <?php include 'includes/header.php'; ?>	
</head>

<body>
    <div id="wrapper">

        <?php include 'includes/headerone.php'; ?>
        <link rel="stylesheet" href="./js/libs/css/ui-lightness/jquery-ui-1.9.2.custom.css" type="text/css" />		

        <link rel="stylesheet" href="./js/plugins/fileupload/bootstrap-fileupload.css" type="text/css" />

        <link rel="stylesheet" href="./css/App.css" type="text/css" />

        <link rel="stylesheet" href="./css/custom.css" type="text/css" />


        <div id="sidebar-wrapper" class="collapse sidebar-collapse">

            <?php
            include 'includes/navigation.php';
            ?>

        </div> <!-- /#sidebar-wrapper -->



        <div id="content">		

            <div id="content-header">
                <h1>Contact Information</h1>
            </div> <!-- #content-header -->	


            <div id="content-container">	
                <div class="portlet">

                    <div class="portlet-header">

                        <h3>
                            <i class="fa fa-group"></i>
                            Contact Information
                        </h3>

                    </div> <!-- /.portlet-header -->

                    <div class="portlet-content">


                        <div class="row">

                            <?php
                            include 'includes/contact_menu.php';
                            ?>

                            <div class="col-md-9 col-sm-8">

                                <div class="tab-content stacked-content">
                                    <div class="tab-pane fade in active" id="address-tab">
                                        <h3 class="">Add Address Information</h3>
                                        <hr />

                                        <br />

                                        <form action="#" method="post" class="form-horizontal">
                                            <?php
                                            if (isset($_POST['saveBtn1'])) {
                                                // echo Input::get('username');
                                                $validate = new Validate();
                                                $validation = $validate->check($_POST, array(
                                                    'plotname' => array(
                                                        'required' => TRUE,
                                                        'min' => 2
                                                    ),
                                                    'boxnumber' => array(
                                                        'required' => TRUE,
                                                        'min' => 2
                                                    )
                                                ));
                                                if ($validation->passed()) {
                                                    //login user

                                                    $plotname = Input::get('plotname');
                                                    $boxnumber = Input::get('boxnumber');
                                                    $district = Input::get('district');
                                                    $country = Input::get('country');
                                                    
                                                    $sql = "select * from jerm_contact";
                                                    $where = 'Contact_Id';
                                                    if (DB::getInstance()->checkRows($sql) > 0):
                                                        $insert_contact = DB::getInstance()->update('jerm_contact', 1, array(
                                                            'Plot_Number' => $plotname,'Box_Number' => $boxnumber
                                                            ,'District' => $district,'Country' => $country), $where);
                                                        $message = "Contacts Updated";
                                                    else:
                                                        $insert_contact = DB::getInstance()->insert('jerm_contact', array(
                                                            'Plot_Number' => $plotname,'Box_Number' => $boxnumber
                                                            ,'District' => $district,'Country' => $country
                                                        ));
                                                        $message = "Contacts Saved";
                                                    endif;

                                                    if ($insert_contact) {
                                                        echo "<h5 align='center' ><strong><font color='green' size='2px'>" . $message . "</font></strong></h5>";
                                                        header("refresh:2;url=index.php?page=" . $crypt->encode('contact_info'));
                                                    }
                                                } else {
                                                    //output errors
                                                    foreach ($validation->errors() as $error) {
                                                        echo "<h5 align='center' ><font color='red'>" . $error . '</font></h5>';
                                                    }
                                                }
                                            }
                                            ?>

                                            <div class="form-group">

                                                <label class="col-md-3">Plot Number</label>

                                                <div class="col-md-7">
                                                    <input type="text" name="plotname" class="form-control"/>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->

                                            <div class="form-group">

                                                <label class="col-md-3">Box Number</label>

                                                <div class="col-md-7">
                                                    <input type="text" name="boxnumber" class="form-control" />
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->

                                            <div class="form-group">

                                                <label class="col-md-3">District</label>

                                                <div class="col-md-7">
                                                    <select name="district" class="form-control">
                                                        <option value="Kampala">Kampala</option>
                                                    </select>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->

                                            <div class="form-group">

                                                <label class="col-md-3">Country</label>

                                                <div class="col-md-7">
                                                    <select name="country" class="form-control">
                                                        <option value="Uganda">Uganda</option>
                                                    </select>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->
                                            <br />

                                            <div class="form-group">

                                                <div class="col-md-7 col-md-push-3">
                                                    <button type="submit" name="saveBtn1" class="btn btn-primary">Save Changes</button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->

                                        </form>


                                    </div>
                                    <div class="tab-pane fade" id="mailing-tab">

                                        <h3 class="">Emails & Telephone</h3>
                                        <hr/>
                                        <br />
                                        <form action="#" method="post" class="form-horizontal">
                                            <?php
                                            if (isset($_POST['saveBtn2'])) {
                                                // echo Input::get('username');
                                                $validate = new Validate();
                                                $validation = $validate->check($_POST, array(
                                                    'email' => array(
                                                        'required' => TRUE,
                                                        'min' => 2
                                                    ),
                                                    'fax' => array(
                                                        'required' => TRUE,
                                                        'min' => 2
                                                    ),
                                                    'telephone' => array(
                                                        'required' => TRUE,
                                                        'min' => 2
                                                    ),
                                                    'website' => array(
                                                        'required' => TRUE,
                                                        'min' => 2
                                                    )
                                                ));
                                                if ($validation->passed()) {
                                                    //login user

                                                    $website = Input::get('website');
                                                    $email = Input::get('email');
                                                    $fax = Input::get('fax');
                                                    $telephone = Input::get('telephone');
                                                    
                                                    $sql = "select * from jerm_contact";
                                                    $where = 'Contact_Id';
                                                    if (DB::getInstance()->checkRows($sql) > 0):
                                                        $insert_contact = DB::getInstance()->update('jerm_contact', 1, array(
                                                            'Email' => $email,'Tel' => $telephone
                                                            ,'Fax' => $fax,'Website' => $website), $where);
                                                        $message = "Contacts Updated";
                                                    else:
                                                        $insert_contact = DB::getInstance()->insert('jerm_contact', array(
                                                            'Email' => $email,'Tel' => $telephone
                                                            ,'Fax' => $fax,'Website' => $website
                                                        ));
                                                        $message = "Contacts Saved";
                                                    endif;

                                                    if ($insert_contact) {
                                                        echo "<h5 align='center' ><strong><font color='green' size='2px'>" . $message . "</font></strong></h5>";
                                                        header("refresh:2;url=index.php?page=" . $crypt->encode('contact_info'));
                                                    }
                                                } else {
                                                    //output errors
                                                    foreach ($validation->errors() as $error) {
                                                        echo "<h5 align='center' ><font color='red'>" . $error . '</font></h5>';
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="form-group">

                                                <label class="col-md-3">Email</label>

                                                <div class="col-md-7">
                                                    <input type="text" name="email" class="form-control"/>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->

                                            <div class="form-group">

                                                <label class="col-md-3">Telephone</label>

                                                <div class="col-md-7">
                                                    <input type="text" name="telephone" class="form-control" />
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->
                                            <div class="form-group">

                                                <label class="col-md-3">Fax</label>

                                                <div class="col-md-7">
                                                    <input type="text" name="fax" class="form-control" />
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->

                                            <div class="form-group">

                                                <label class="col-md-3">Website</label>

                                                <div class="col-md-7">
                                                    <input type="text" placeholder="http://www.mysite.com" name="website" class="form-control" />
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->
                                            <div class="form-group">

                                                <div class="col-md-7 col-md-push-3">
                                                    <button type="submit" name="saveBtn2" class="btn btn-primary">Save Changes</button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->
                                        </form>

                                    </div>
                                    <div class="tab-pane fade" id="working-tab">

                                        <h3 class="">Working Hours & Days</h3>
                                        <hr/>
                                        <br />
                                        <form action="#" class="form-horizontal">
                                            <div class="form-group">

                                                <label class="col-md-3">Day From</label>

                                                <div class="col-md-7">
                                                    <select class="form-control">
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                        <option value="Saturday">Saturday</option>
                                                        <option value="Sunday">Sunday</option>
                                                    </select>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->

                                            <div class="form-group">

                                                <label class="col-md-3">Day To</label>

                                                <div class="col-md-7">
                                                    <select class="form-control">
                                                        <option value="">None</option>
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                        <option value="Saturday">Saturday</option>
                                                        <option value="Sunday">Sunday</option>
                                                    </select>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->
                                            <div class="form-group">

                                                <label class="col-md-3">Time From</label>

                                                <div class="col-md-4">
                                                    <input type="text" name="user-name" class="form-control" />
                                                </div> 
                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                </div>
                                            </div> <!-- /.form-group -->

                                            <div class="form-group">

                                                <label class="col-md-3">Time To</label>

                                                <div class="col-md-4">
                                                    <input type="text" name="first-name" class="form-control" />
                                                </div> 
                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option value="AM">AM</option>
                                                        <option value="PM">PM</option>
                                                    </select>
                                                </div>

                                            </div> <!-- /.form-group -->
                                            <div class="form-group">

                                                <div class="col-md-7 col-md-push-3">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    &nbsp;
                                                    <button type="reset" class="btn btn-default">Cancel</button>
                                                </div> <!-- /.col -->

                                            </div> <!-- /.form-group -->
                                        </form>

                                    </div>
                                </div>
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

    <script src="./js/plugins/fileupload/bootstrap-fileupload.js"></script>
    <script src="./js/plugins/textarea-counter/jquery.textarea-counter.js"></script>

    <script src="./js/App.js"></script>


    <script>

        $(function () {

            $('#about-textarea').textareaCount({
                maxCharacterSize: 400
            });

        });

    </script>

</body>
</html>
