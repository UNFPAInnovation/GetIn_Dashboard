<?php

function escape($string) {
    return htmlentities($string);
}

function ugandan_shillings($value) {
    $value = number_format($value, 2, ".", ",");
    return $value . " UGX";
}

function seperators($value) {
    $value = number_format($value, 0, ".", ",");
    return $value . " ";
}

function format_date($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, 'jS M Y');
    return $new_date;
}

function limit_words($string, $word_limit) {
    $words = explode(" ", $string);
    if (count($words) > $word_limit) {
        return implode(" ", array_splice($words, 0, $word_limit));
    } else {
        return $string;
    }
}

function redirect($message, $url) {
    ?>
    <script type="text/javascript">
        //        function Redirect()
        //        {
        //            window.location = "<?php echo $url; ?>";
        //        }
        //        alert('<?php echo $message; ?>');
        // setTimeout(redirect(), 10);
        alert('<?php echo $message; ?>');
        window.location = "<?php echo $url; ?>"
    </script>
    <?php
}

function descStatus($status_id) {
    if ($status_id == 5) {
        echo "<font color='green'><strong>COMPLETED</strong></font>";
    } elseif ($status_id == 3) {
        echo "<font color='green'><strong>ASSIGNED<strong></font>";
    } else {
        echo 'Unknown Status';
    }
}

function streamline_date($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, 'jS M Y');
    return $new_date;
}

//Returns the date in an english formatted manner. eg 24-01-2016
function plain_date($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, 'd-m-Y');
    return $new_date;
}

//Returns the date in an english formatted manner but this time with the specific time. eg 24th January 2016 at 09:00 am
function streamline_date_time($date) {
    $create_date = date_create($date);
    $new_date = date_format($create_date, 'l, jS F Y \a\t g:ia');
    return $new_date;
}

function calcAge($date1, $date2) {
    $date1 = date_create($date1);
    $date2 = date_create($date2);
    $diff12 = date_diff($date2, $date1);
    $days = $diff12->d;
    $months = $diff12->m;
    $years = $diff12->y;
    return $years;
}

function group_range($val, $min, $max) {
    return ($val >= $min && $val <= $max);
}

function file_fetch_contents($url) {
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
    $contents = curl_exec($curl_handle);
    curl_close($curl_handle);

    return $contents;
}
//require_once('AfricasTalkingGateway.php');
//include('../classes/AfricasTalkingGateway.php');
/*

  # COPYRIGHT (C) 2014 AFRICASTALKING LTD <www.africastalking.com>                                                   
 
  AFRICAStALKING SMS GATEWAY CLASS IS A FREE SOFTWARE IE. CAN BE MODIFIED AND/OR REDISTRIBUTED                        
  UNDER THE TERMS OF GNU GENERAL PUBLIC LICENCES AS PUBLISHED BY THE                                                 
  FREE SOFTWARE FOUNDATION VERSION 3 OR ANY LATER VERSION                                                            
 
  THE CLASS IS DISTRIBUTED ON 'AS IS' BASIS WITHOUT ANY WARRANTY, INCLUDING BUT NOT LIMITED TO                       
  THE IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.                     
  IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,            
  WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE       
  OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 
*/

class AfricasTalkingGatewayException extends Exception  {}

class AfricasTalkingGateway
{
  protected $_username;
  protected $_apiKey;
  
  protected $_requestBody;
  protected $_requestUrl;
  
  protected $_responseBody;
  protected $_responseInfo;
    
  //Turn this on if you run into problems. It will print the raw HTTP response from our server
  const Debug             = false;
  
  const HTTP_CODE_OK      = 200;
  const HTTP_CODE_CREATED = 201;
  
  public function __construct($username_, $apiKey_, $environment_ = "production")
  {
    $this->_username     = $username_;
    $this->_apiKey       = $apiKey_;

    $this->_environment  = $environment_;
    
    $this->_requestBody  = null;
    $this->_requestUrl   = null;
    
    $this->_responseBody = null;
    $this->_responseInfo = null;    
  }
  
  
  //Messaging methods
  public function sendMessage($to_, $message_, $from_ = null, $bulkSMSMode_ = 1, Array $options_ = array())
  {
    if ( strlen($to_) == 0 || strlen($message_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply both to and message parameters');
    }
    
    $params = array(
		    'username' => $this->_username,
		    'to'       => $to_,
		    'message'  => $message_,
		    );
    
    if ( $from_ !== null ) {
      $params['from']        = $from_;
      $params['bulkSMSMode'] = $bulkSMSMode_;
    }
    
    //This contains a list of parameters that can be passed in $options_ parameter
    if ( count($options_) > 0 ) {
      $allowedKeys = array (
			    'enqueue',
			    'keyword',
			    'linkId',
			    'retryDurationInHours'
			    );
			    
      //Check whether data has been passed in options_ parameter
      foreach ( $options_ as $key => $value ) {
	if ( in_array($key, $allowedKeys) && strlen($value) > 0 ) {
	  $params[$key] = $value;
	} else {
	  throw new AfricasTalkingGatewayException("Invalid key in options array: [$key]");
	}
      }
    }
    
    $this->_requestUrl  = $this->getSendSmsUrl();
    $this->_requestBody = http_build_query($params, '', '&');
    
    $this->executePOST();
    
    if ( $this->_responseInfo['http_code'] == self::HTTP_CODE_CREATED ) {
      $responseObject = json_decode($this->_responseBody);
      if(count($responseObject->SMSMessageData->Recipients) > 0)
	return $responseObject->SMSMessageData->Recipients;
	  
      throw new AfricasTalkingGatewayException($responseObject->SMSMessageData->Message);
    }
    
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }
  

  public function fetchMessages($lastReceivedId_)
  {
    $username = $this->_username;
    $this->_requestUrl = $this->getSendSmsUrl().'?username='.$username.'&lastReceivedId='. intval($lastReceivedId_);
    
    $this->executeGet();
         
    if ( $this->_responseInfo['http_code'] == self::HTTP_CODE_OK ) {
      $responseObject = json_decode($this->_responseBody);
      return $responseObject->SMSMessageData->Messages;
    }
    
    throw new AfricasTalkingGatewayException($this->_responseBody);    
  }
  
  
  //Subscription methods
  public function createSubscription($phoneNumber_, $shortCode_, $keyword_, $checkoutToken_)
  {
  	
    if ( strlen($phoneNumber_) == 0 || strlen($shortCode_) == 0 || strlen($keyword_) == 0 || strlen($checkoutToken_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply phoneNumber, shortCode, keyword and checkoutToken');
    }
    
    $params = array(
		    'username'      => $this->_username,
		    'phoneNumber'   => $phoneNumber_,
		    'shortCode'     => $shortCode_,
		    'keyword'       => $keyword_,
        'checkoutToken' => $checkoutToken_,
		    );
    
    $this->_requestUrl  = $this->getSubscriptionUrl("/create");
    $this->_requestBody = http_build_query($params, '', '&');
    
    $this->executePOST();
    
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_CREATED )
      throw new AfricasTalkingGatewayException($this->_responseBody);
     
    return json_decode($this->_responseBody);
  }

  public function deleteSubscription($phoneNumber_, $shortCode_, $keyword_)
  {
    if ( strlen($phoneNumber_) == 0 || strlen($shortCode_) == 0 || strlen($keyword_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply phoneNumber, shortCode and keyword');
    }
    
    $params = array(
		    'username'    => $this->_username,
		    'phoneNumber' => $phoneNumber_,
		    'shortCode'   => $shortCode_,
		    'keyword'     => $keyword_
		    );
    
    $this->_requestUrl  = $this->getSubscriptionUrl("/delete");
    $this->_requestBody = http_build_query($params, '', '&');
    
    $this->executePOST();
    
    if ( $this->_responseInfo['http_code'] != self::HTTP_CODE_CREATED )
      throw new AfricasTalkingGatewayException($this->_responseBody);
     
    return json_decode($this->_responseBody);
     
  }
  
  public function fetchPremiumSubscriptions($shortCode_, $keyword_, $lastReceivedId_ = 0)
  {
    $params  = '?username='.$this->_username.'&shortCode='.$shortCode_;
    $params .= '&keyword='.$keyword_.'&lastReceivedId='.intval($lastReceivedId_);
    $this->_requestUrl  = $this->getSubscriptionUrl($params);
    
    $this->executeGet();
    
    if ( $this->_responseInfo['http_code'] == self::HTTP_CODE_OK ) {
      $responseObject = json_decode($this->_responseBody);
      return $responseObject->responses;
    }
    
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }
  
  
  //Call methods
  public function call($from_, $to_)
  {
    if ( strlen($from_) == 0 || strlen($to_) == 0 ) {
      throw new AfricasTalkingGatewayException('Please supply both from and to parameters');
    }
    
    $params = array(
		    'username' => $this->_username,
		    'from'     => $from_,
		    'to'       => $to_
		    );
    
    $this->_requestUrl  = $this->getVoiceUrl() . "/call";
    $this->_requestBody = http_build_query($params, '', '&');
    
    $this->executePOST();
     
    if(($responseObject = json_decode($this->_responseBody)) !== null) {
      if(strtoupper(trim($responseObject->errorMessage)) == "NONE") {
	return $responseObject->entries;
      }
      throw new AfricasTalkingGatewayException($responseObject->errorMessage);
    }
    else
      throw new AfricasTalkingGatewayException($this->_responseBody);
  }
  
  public function getNumQueuedCalls($phoneNumber_, $queueName = null) 
  {  	
    $this->_requestUrl = $this->getVoiceUrl() . "/queueStatus";
    $params = array(
		    "username"     => $this->_username, 
		    "phoneNumbers" => $phoneNumber_
		    );
    if($queueName !== null)
      $params['queueName'] = $queueName;
    $this->_requestBody   = http_build_query($params, '', '&');
    $this->executePOST();
  	
    if(($responseObject = json_decode($this->_responseBody)) !== null) {
      if(strtoupper(trim($responseObject->errorMessage)) == "NONE")
	return $responseObject->entries;
      throw new AfricasTalkingGatewayException($responseObject->ErrorMessage);
    }
  		
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }

		
  public function uploadMediaFile($url_, $phoneNumber_) 
  {
    $params = array(
		    "username"    => $this->_username, 
		    "url"         => $url_,
        "phoneNumber" => $phoneNumber_
		    );
  	             
    $this->_requestBody = http_build_query($params, '', '&');
    $this->_requestUrl  = $this->getVoiceUrl() . "/mediaUpload";
  	
    $this->executePOST();
  }
  
  
  //Airtime method
  public function sendAirtime($recipients) 
  {
    $params = array(
		    "username"    => $this->_username, 
		    "recipients"  => $recipients
		    );
    $this->_requestUrl  = $this->getAirtimeUrl("/send");
    $this->_requestBody = http_build_query($params, '', '&');
  	
    $this->executePOST();
  	
    if($this->_responseInfo['http_code'] == self::HTTP_CODE_CREATED) {
      $responseObject = json_decode($this->_responseBody);
      if(count($responseObject->responses) > 0)
	return $responseObject->responses;
  			
      throw new AfricasTalkingGatewayException($responseObject->errorMessage);
    }
  	
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }

  // Payments
  public function initiateMobilePaymentCheckout($productName_,
						$phoneNumber_,
						$currencyCode_,
						$amount_,
						$metadata_) {
    $this->_requestBody = json_encode(array("username"     => $this->_username,
					    "productName"  => $productName_,
					    "phoneNumber"  => $phoneNumber_,
					    "currencyCode" => $currencyCode_,
					    "amount"       => $amount_,
					    "metadata"     => $metadata_));
    $this->_requestUrl  = $this->getMobilePaymentCheckoutUrl();
    
    $this->executeJsonPOST();
    if($this->_responseInfo['http_code'] == self::HTTP_CODE_CREATED) {
      $response = json_decode($this->_responseBody);
      if ( $response->status == "PendingConfirmation") return $response->transactionId;
      else throw new AfricasTalkingGatewayException($response->description);
    }
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }

  public function mobilePaymentB2CRequest($productName_,
					  $recipients_) {
    $this->_requestBody = json_encode(array("username"     => $this->_username,
					    "productName"  => $productName_,
					    "recipients"   => $recipients_));
    $this->_requestUrl  = $this->getMobilePaymentB2CUrl();
    
    $this->executeJsonPOST();
    if($this->_responseInfo['http_code'] == self::HTTP_CODE_CREATED) {
      $response = json_decode($this->_responseBody);
      $entries  = $response->entries;
      if (count($entries) > 0) return  $entries;      
      else throw new AfricasTalkingGatewayException($response->errorMessage);
    }
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }

  public function mobilePaymentB2BRequest($productName_, $providerData_, $currencyCode_, $amount_, $metadata_) {
		if(!isset($providerData_['provider']) || strlen($providerData_['provider']) == 0)
			throw new AfricasTalkingGatewayException("Missing field provider");
		
		if(!isset($providerData_['destinationChannel']) || strlen($providerData_['destinationChannel']) == 0)
			throw new AfricasTalkingGatewayException("Missing field destinationChannel");

    if(!isset($providerData_['destinationAccount']) || strlen($providerData_['destinationAccount']) == 0)
      throw new AfricasTalkingGatewayException("Missing field destinationAccount");
		
		if(!isset($providerData_['transferType']) || strlen($providerData_['transferType']) == 0)
			throw new AfricasTalkingGatewayException("Missing field transferType");
		
		$params = array("username" => $this->_username,
										"productName"  => $productName_,
										"currencyCode" => $currencyCode_,
										"amount"=>$amount_,
										'provider' => $providerData_['provider'],
										'destinationChannel' => $providerData_['destinationChannel'],
                    'destinationAccount' => $providerData_['destinationAccount'],
										'transferType' => $providerData_['transferType'],
										'metadata' => $metadata_);
		
    $this->_requestBody = json_encode($params);
    $this->_requestUrl  = $this->getMobilePaymentB2BUrl();
    
    $this->executeJsonPOST();
    if($this->_responseInfo['http_code'] == self::HTTP_CODE_CREATED) {
      $response = json_decode($this->_responseBody);
      return $response;
    }
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }
  
  //User info method
  public function getUserData()
  {
    $username = $this->_username;
    $this->_requestUrl = $this->getUserDataUrl('?username='.$username);
    $this->executeGet();
    
    if ( $this->_responseInfo['http_code'] == self::HTTP_CODE_OK ) {
      $responseObject = json_decode($this->_responseBody);
      return $responseObject->UserData;
    }
    	
    throw new AfricasTalkingGatewayException($this->_responseBody);
  }
  
  private function executeGet ()
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Accept: application/json',
							 'apikey: ' . $this->_apiKey));
    $this->doExecute($ch);
  }
  
  private function executePost ()
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_requestBody);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Accept: application/json',
							 'apikey: ' . $this->_apiKey));
    
    $this->doExecute($ch);
  }
  
  private function executeJsonPost ()
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_requestBody);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
					       'Content-Length: ' . strlen($this->_requestBody),
					       'apikey: ' . $this->_apiKey));
    $this->doExecute($ch);
  }
  
  private function doExecute (&$curlHandle_)
  {
    try {
	   	
      $this->setCurlOpts($curlHandle_);
      $responseBody = curl_exec($curlHandle_);
			    
      if ( self::Debug ) {
	echo "Full response: ". print_r($responseBody, true)."\n";
      }
			    
      $this->_responseInfo = curl_getinfo($curlHandle_);
			    
      $this->_responseBody = $responseBody;
      curl_close($curlHandle_);
    }
	   
    catch(Exeption $e) {
      curl_close($curlHandle_);
      throw $e;
    }
  }
  
  private function setCurlOpts (&$curlHandle_)
  {
    curl_setopt($curlHandle_, CURLOPT_TIMEOUT, 60);
    curl_setopt($curlHandle_, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curlHandle_, CURLOPT_URL, $this->_requestUrl);
    curl_setopt($curlHandle_, CURLOPT_RETURNTRANSFER, true);
  }

  private function getApiHost() {
    return ($this->_environment == 'sandbox') ? 'https://api.sandbox.africastalking.com' : 'https://api.africastalking.com';
  }

  private function getPaymentHost() {
    return ($this->_environment == 'sandbox') ? 'https://payments.sandbox.africastalking.com' : 'https://payments.africastalking.com';
  }

  private function getVoiceHost() {
    return ($this->_environment == 'sandbox') ? 'https://voice.sandbox.africastalking.com' : 'https://voice.africastalking.com';
  }
  
  private function getSendSmsUrl($extension_ = "") {
    return $this->getApiHost().'/version1/messaging'.$extension_;
  }
    
  private function getVoiceUrl() {
    return $this->getVoiceHost();
  }
  
  private function getUserDataUrl($extension_) {
    return $this->getApiHost().'/version1/user'.$extension_;
  }
  
  private function getSubscriptionUrl($extension_) {
    return $this->getApiHost().'/version1/subscription'.$extension_;
  }
  
  private function getAirtimeUrl($extension_) {
    return $this->getApiHost().'/version1/airtime'.$extension_;
  }

  private function getMobilePaymentCheckoutUrl() {
    return $this->getPaymentHost().'/mobile/checkout/request';
  }

  private function getMobilePaymentB2CUrl() {
    return $this->getPaymentHost().'/mobile/b2c/request';
  }

  private function getMobilePaymentB2BUrl() {
    return $this->getPaymentHost().'/mobile/b2b/request';
  }
}
function send_sms($phone, $message) {
//    $sms_username = "unfair";
//    $sms_password = "unf41r";
//    $sms_phone_number = $phone;
//    $sms_message = $message;
//    $sms_message = urlencode($sms_message);
//    //$url = "http://www.socnetsolutions.com/projects/bulk/amfphp/services/blast.php?username={$sms_username}&passwd={$sms_password}&msg={$sms_message}&type=text&from=UNFPA&numbers={$sms_phone_number}";
//    $url = "http://www.socnetsolutions.com/projects/bulk/amfphp/services/blast.php?username={$sms_username}&passwd={$sms_password}&from=UNFPA_GetIn_Project&numbers={$sms_phone_number}&msg={$sms_message}";
//    $api_reply = file_fetch_contents($url);
//    echo $api_reply;
    // $user = "unfair";
    // $pass = "unf41r";
    // $msg = urlencode($message." - FROM ".$sender);

    // $url = "http://www.socnetsolutions.com/projects/bulk/amfphp/services/blast.php?username={$user}&passwd={$pass}&from=UNFPA_GetIn_Project&numbers={$phone}&msg={$msg}";//http://www.socnetsolutions.com/projects/bulk/amfphp/services/blast.php?username=$user&passwd=$pass&from=$sender&numbers=256775131098&msg=%s";
    //    echo $url;
    // $contents = file_fetch_contents($url);
    //echo "<script>window.open('$url','_blank')</script>";
    // print_r($contents); // check this to see if sent or not
    $sender = "UNFPA - GetIn Project";
    $recipients = $phone;
    $username = "Donald Waruhanga";
    $apikey = "ae36f17fe7916232b8d9db06a9e0c798eaec0f396245477979f6d27f883e74e3";
    // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    try{
        $results = $gateway->sendMessage($recipients, $message);
    }
    catch ( AfricasTalkingGatewayException $e )
    {
        echo "Encountered an error while sending: ".$e->getMessage();
    }
    return TRUE;
}

function cleanData($str) {
    if ($str == 't')
        $str = 'TRUE';
    if ($str == 'f')
        $str = 'FALSE';
    if (preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) {
        $str = "'$str";
    }
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

/*
 * adding months to a specific date
 */

function addMonthsToDate($months, $dateCovert) {
    $date = date_create($dateCovert);
    date_add($date, date_interval_create_from_date_string($months . ' months'));
    return date_format($date, 'Y-m-d');
}

function addDaysToDate($days, $dateCovert) {
    $date = date_create($dateCovert);
    date_add($date, date_interval_create_from_date_string($days . ' days'));
    return date_format($date, 'Y-m-d');
}
?>
