<?php
$user=new User();
$user->logout();
Redirect::to('index.php?page=login');
?>