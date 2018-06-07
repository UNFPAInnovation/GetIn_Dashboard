<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?php
require 'vendor/autoload.php';

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
?>
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
                    <h1>Compose/Edit Reminder Messages</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-envelope"></i>
                                Compose/Edit Reminder Messages
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">
                            <form action="#" method="post">
                                <?php
                                if (Input::exists()) {
                                    // echo Input::get('username');
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'tag' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        ),
                                        'message' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        )
                                    ));
                                    if ($validation->passed()) {
                                        $uuid =  Uuid::uuid4()->toString();
                                        $now = date("Y-m-d h:i:s");
                                        $message = Input::get('message');
                                        $tag = Input::get('tag');
                                        $sql = "select * from messages";
                                        ///$where = 'Message_Id';;
                                        $where = 'tag';
                                        if (DB::getInstance()->checkRows($sql) > 0):
                                            $insert_message = DB::getInstance()->update('core_smsmessage', 1, array(
                                                'text' => $tag, 'modified' => $now), $where);
                                            $message = "Message Updated";
                                        else:
                                            $insert_message = DB::getInstance()->insert('core_smsmessage', array(
                                                'uuid' => $uuid,
                                                'text' => $message,
                                                'tag' => $tag,
                                                'created' => $now,
                                                'modified' => $now
                                            ));
                                            $message = "Message Saved";
                                        endif;

                                        if ($insert_message) {
                                            echo "<h5 align='center' ><strong><font color='green' size='2px'>" . $message . "</font></strong></h5>";
                                            //header("refresh:2;url=index.php?page=messages");
                                        }
                                    } else {
                                        //output errors
                                        foreach ($validation->errors() as $error) {
                                            echo "<h5 align='center' ><font color='red'>" . $error . '</font></h5>';
                                        }
                                    }
                                }
                                ?>
                                <?php
                                $messages = '';
                                $amount_f = DB::getInstance()->query("SELECT * FROM core_smsmessage");
                                foreach ($amount_f->results() as $amount_f) {
                                    $messages = $amount_f->text;
                                }
                                ?>
                                <div class="row">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">

                                        <div class="form-group">
                                            <label for="tag">Enter tag(128 characters Only)</label>
                                            <textarea type="text" id="id_tag" name="tag" class="form-control">
                                                <?php echo $messages; ?>
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message (130 Characters Only)</label>
                                            <textarea type="text" id="username-input" name="message" class="form-control">
                                                <?php echo $messages; ?>
                                            </textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success fa fa-envelope"> Create Message</button>

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
