<?php
require_once("src/sms-gateway/AfricasTalkingGateway.php");
require_once "vendor/autoload.php";

use League\Csv\Reader;
use League\Csv\Statement;

//load environment variables
$dotenv = new Dotenv\Dotenv(__DIR__, 'example.env');
$dotenv->load();

//re-usaables
$signOff = "From GetIN Team";
$aitKey = getenv('AIT_KEY');
$aitUsername = getenv('AIT_USERNAME');
$messager = new AfricasTalkingGateway($aitUsername, $aitKey);

//get csv file
$csv = Reader::createFromPath('data/users.csv', 'r');
$csv->setHeaderOffset(0); //set the CSV header offset


//split list - midwives and chews
$midwives = (new Statement())->offset(0)->limit(16);
$midwifeList =  $midwives->process($csv); //process the CVS file to get midwife list

$chews = (new Statement())->offset(48)->limit(10);//select chews starting from row 17
$chewsList = $chews->process($csv); //process the CVS file to get chews list


//send smses
foreach ($chewsList as $chew) {
	$message = getenv('CHEWS_MSG_PART_1')." ".$chew['lname']." ".$chew['fname'].", your new username is: ".$chew['username']." phone number is: 0".$chew['phone'].". ".getenv('CHEWS_MSG_PART_2')." ".$signOff;
	$messager->sendMessage("+256".$chew['phone'], $message);
} 

foreach ($midwifeList as $midwife) {
	$message = getenv('MIDWIFE_MSG_PART_1')." ".$midwife['lname']." ".$midwife['fname'].", your new username is: ".$midwife['username']." phone number is: 0".$midwife['phone'].". ".getenv('MIDWIFE_MSG_PART_2')." ".$signOff;
	$messager->sendMessage("+256".$midwife['phone'], $message);
}

?>