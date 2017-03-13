<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php include 'includes/header.php'; ?>	
        <link rel="stylesheet" href="./css/custom.css" type="text/css" />
     <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
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
                    <h1>Terms Of Service</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-list"></i>
                                Terms Of Service
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">
                            <form action="#" method="post">
                                   <?php
                                if (Input::exists()) {
                                    // echo Input::get('username');
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'terms' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        )
                                    ));
                                    if ($validation->passed()) {
                                        //login user

                                        $terms = Input::get('terms');
                                        $sql = "select * from jerm_terms";
                                         $where = 'Id';
                                        if (DB::getInstance()->checkRows($sql) > 0):
                                            $insert_terms = DB::getInstance()->update('jerm_terms', 1, array(
                                                'Terms' => $terms), $where);
                                            $message = "Terms of Services Updated";
                                        else:
                                            $insert_terms = DB::getInstance()->insert('jerm_terms', array(
                                                'Terms' => $terms
                                            ));
                                            $message = "Terms of Service Saved";
                                        endif;

                                        if ($insert_terms) {
                                            echo "<h5 align='center' ><strong><font color='green' size='2px'>" . $message . "</font></strong></h5>";
                                            header("refresh:2;url=index.php?page=" . $crypt->encode('terms_of_service'));
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
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                        <label for="terms">Terms of Service</label>
                                        <textarea rows="30" name="terms" class="form-control">
                                            <?php
                                        $terms_ret = DB::getInstance()->query("SELECT * FROM jerm_terms");
                                                foreach ($terms_ret->results() as $terms_ret) {
                                                    $value_=$terms_ret->Terms;
                                                }
                                                echo $value_;
                                                    ?>

                                        </textarea>
                                    </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success fa fa-list"> Save Terms</button>

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
