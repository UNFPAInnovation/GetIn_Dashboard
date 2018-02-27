<?php
/**
 *  class to handle all GetIN SMS within the dashboard
 */
 /**
  *
  */
 class GetINSMS
 {
   private protected $apiKey;
   private protected $username;
   function __construct()
   {
     $this->username = getenv('AIT_USERNAME');
     $this->apikey = getenv('API_KEY');
   }

 }

 ?>
