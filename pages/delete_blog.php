<?php
$id=  Input::get("_id");
DB::getInstance()->query("delete from jerm_blog where Id=".$id);
redirect("Blog Deleted Successfully", "index.php?page=".$crypt->encode('list_blog'));