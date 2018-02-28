<?php
/**
 *  class to handle all GetIN SMS within the dashboard
 */

 /**
  * CONSTANTS
  */
  define("AIT_USERNAME", getenv('AIT_USERNAME'));
  define("API_KEY", getenv('API_KEY'));

 class GetINSMS
 {
   protected $_gateway;
   public $_result = FALSE;
   public $_results = array();
   public function __construct()
   {
     $this->_gateway = new \AfricasTalkingGateway(AIT_USERNAME, API_KEY);
   }

   /**
    * Send SMS to just one number
    */
   public function sendToNumber($number, $msg){
     $number = "+".$number; //prefix '+'
     try {
       $res = $this->_gateway->sendMessage($number, $msg);
       foreach ($res as $result) {
         $this->_result = (($result->status === 'Success') ? TRUE : FALSE);
       }
     } catch (\AfricasTalkingGatewayException $e) {
       echo "Something went wrong while sending the message: ".$e->getMessage();
     }
     return $this->_result;
   }

   /**
    * Send SMS to many numbers
    */
   public function sendToMany($numbers, $msg){
     $numbers = "+".$numbers; //prefix '+'
     try {
       $res = $this->_gateway->sendMessage($numbers, $msg);
       foreach ($res as $result) {
         array_push($this->_results, array("number" => $result->number, "status" => (($result->status === 'Success') ? TRUE : FALSE)));
       }
     } catch (\AfricasTalkingGatewayException $e) {
       echo "Something went wrong while sending the message: ".$e->getMessage();
     }
     return $this->_results;
   }

 }

 ?>
