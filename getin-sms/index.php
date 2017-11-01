<?php
namespace GetIN;

require_once "vendor/autoload.php";

final class GetINNotifications{
	protected $sms;
	protected $env;

	function __construct(){
		$this->env = getenv('APP_ENV');
		$this->sms = new AfricasTalkingGateway(getenv('AIT_USERNAME'), getenv('AIT_KEY'));
	}

	public function sendSMS($recipients, $message){
		$failedRecipients = array(); //track failed deliveries
		$passedRecipients = array(); //track successful deliveries

		try {
			foreach ($recipients as $key => $value) {
				$results = $this->sms->sendMessage($contact, $message);
				for ($i=0; $i < sizeof($results); $i++) { 
					if ($results[$i]->status !== "Success") {
						array_push($failedRecipients, $results[$i]->number); 
					} else{
						array_push($passedRecipients, $results[$i]->number);
					}
				}
			}
		} catch (Exception $e) {
			$smsStatus = array("status" => "error", "error" => $e->getErrorMessage());
			if ($this->env != 'production') {
				print_r($smsStatus);
			}
		}

		$smsStatus = array("successful" => $passedRecipients, "failed" => $failedRecipients);
		return $smsStatus;
	}
}

?>