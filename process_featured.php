<?php
//error_reporting(0);
session_start();
include 'core/init.php';
$crypt=new Encryption();
unset($_SESSION['featured']);
$productId = Input::get("product_id");
$where="Product_Id";
$set_featured = DB::getInstance()->update('jerm_products', $productId, array(
    'Featured' => 1), $where);
if($set_featured):
    $_SESSION['featured']='Product Set Successfully';
    Redirect::to('index.php?page='.$crypt->encode('set_featured'));
    else:
        echo 'error';
        
endif;
?>
