<?php
class Session{
    
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? TRUE : FALSE;
    }
    
    public static function put($name,$value){
        return $_SESSION[$name]=$value;
    }
    
    public static function get($name){
        return ($_SESSION[$name]);
    }

    public static  function delete($name){
     if(self::exists($name)){
         unset($_SESSION[$name]);
     }   
    }
    public static  function flash($name,$string='')
    {
        if(self::exists($name)){
            $session=  self::get($name);
            self::delete($name);
            return $session;
        }  else {
            self::put($name, $string) ;
        }
        return '';
    }
    
    public static function getUser(){
    
    }
    
    public static function getActiveDistrict(){
        $_oid =  $_SESSION['getin_observer_id'];
        $district_id = DB::getInstance()->getName('core_observer', $_oid, 'district_id', 'id');
        $sql = "SELECT * from core_district WHERE id = $district_id";
        $district = DB::getInstance()->query($sql)->first();
        return $district;    
    }
}
?>