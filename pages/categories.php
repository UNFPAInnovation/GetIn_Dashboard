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
                    <h1>Product Categories</h1>
                </div> <!-- #content-header -->	


                <div id="content-container">	
                    <div class="portlet">

                        <div class="portlet-header">

                            <h3>
                                <i class="fa fa-list"></i>
                                Product Categories
                            </h3>

                        </div> <!-- /.portlet-header -->

                        <div class="portlet-content">
                            <form action="#" method="post">
                                <?php
                                if (Input::exists()) {
                                   // echo Input::get('username');
                                    $validate = new Validate();
                                    $validation = $validate->check($_POST, array(
                                        'parent_category' => array(
                                            'required' => TRUE,
                                            'min' => 2
                                        )
                                    ));
                                    if ($validation->passed()) {
                                        //login user
                                        $parent_category = Input::get('parent_category');
                                        $child_category = Input::get('child_category');
                                        $insert_categories = DB::getInstance()->insert('jerm_categories', array(
                                            'Parent_Category' => $parent_category,
                                            'Child_Category' => $child_category
                                        ));
                                        if($insert_categories){
                                           echo "<h5 align='center' ><strong><font color='green' size='2px'>Product Category Saved</font></strong></h5>"; 
                                           header("refresh:1;url=index.php?page=".$crypt->encode('categories'));
                                        }
                                    } else {
                                        //output errors
                                        foreach ($validation->errors() as $error) {
                                            echo "<h5 align='center' ><font color='red'>".$error . '</font></h5>';
                                        }
                                    }
                                }
                                ?>
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5">

                                    <div class="form-group">
                                        <label for="parent-cat">Parent Category</label>
                                        <input type="text" value="<?php echo Input::get("parent_category"); ?>" name="parent_category" id="parent-input" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="child-cat">Child Category</label>
                                        <select type="text" name="child_category" id="child-input" class="form-control">
                                            
                                            <?php
                                            echo DB::getInstance()->dropDowns('jerm_categories','Category_Id','Parent_Category');
                                            
                                            ?>
                                            <option selected="selected" value="0">None</option>
                                        </select>
                                    </div>
                                     <button type="submit" class="btn btn-success fa fa-list"> Add Category</button>

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
