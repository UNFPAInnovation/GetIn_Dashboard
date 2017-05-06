<?php

class Hash {

//    public static  function make($string,$salt=''){
//        return hash('sha256',$string.$salt);
//    }
    public static function make($string_password, $encoded_password) {
        $send_pwd_python = exec("python checkpassword.py $string_password '$encoded_password'");
        return $send_pwd_python;
    }

    public static function salt($length) {
        return mcrypt_create_iv($length);
    }

    public static function unique() {
        return self::make(uniqid());
    }

}

?>