<?php 
$vgrp = Input::get("vgrp");
$param =  Input::get("vgrp");
if(!isset($vgrp)){    
    $vgrp = '0'; 
} 
$voucher_query = ''; 
$select = '';
switch ($vgrp) {
    case '0':
        $voucher_query = '';
        break;
    case '1':
        $voucher_query = "WHERE COALESCE(system_id, '') = ''";
        break;
    case '2':
        $voucher_query = "WHERE system_id LIKE ''";
        $voucher_query = "WHERE COALESCE(system_id, '') != ''";
        break;
    case '3':
        $voucher_query = "WHERE system_id LIKE 'HBBH%'"; 
        break;
    case '4':
        $voucher_query = "WHERE system_id  LIKE 'FPUG%'";
        break;
    case '5':
        $voucher_query = "WHERE system_id LIKE 'SMA%'";
        break;
    case '6':
        $voucher_query = "WHERE system_id LIKE 'LKUP%'";
        break;
}

//define ("DB_HOST", $_SERVER['DB_HOST']);
//define ("DB_USER", $_SERVER['DB_USER']);
//define ("DB_PASS", $_SERVER['DB_PASS']);
//define ("DB_NAME", $_SERVER['DB_NAME']);
/*
define ("DB_HOST", Config::get('mysql/host'));
define ("DB_USER", Config::get('mysql/username'));
define ("DB_PASS", Config::get('mysql/password'));
define ("DB_NAME", Config::get('mysql/db'));
$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $link) or die("Couldn't select database");
*/
$setCounter = 0;

$setExcelName = 'patient_info_';
$timestamp = date("Ymd-His");
$district_id = $_SESSION['getin_district'];
$district = DB::getInstance()->getName('core_district', $district_id, 'name', 'id');
$setSql = "select * from core_patients ".$voucher_query." AND district LIKE '".$district."';";

//$setRec = mysql_query($setSql);
$db = DB::getInstance();
$setRec = $db->query($setSql);

//$setCounter = mysql_num_fields($setRec); 
$setCounter = $db->columnCount(); 

$setMainHeader = '';
$columns = $db->columns();
for ($i = 0; $i < $setCounter; $i++) {
    //$setMainHeader .= mysql_field_name($setRec, $i)."\t";
    if( $i > 0){
        $setMainHeader .= "\t";
    }
    $setMainHeader .= '"'.$columns[$i].'"';
}
$setData = '';
foreach($db->results() as $rec)  {
  $rowLine = '';
  foreach($rec as $value)       {
    if(!isset($value) || $value == "")  {
      $value = "\t";
    }   else  {
        //It escape all the special charactor, quotes from the data.
        $value = strip_tags(str_replace('"', '""', $value));
        $value = '"' . $value . '"' . "\t";
    }
    $rowLine .= $value;
  }
  $setData .= trim($rowLine)."\n";
}
 $setData = str_replace("\r", "", $setData);
if ($setData == "") {
  $setData = "\nno matching records found\n";
}

//$setCounter = mysql_num_fields($setRec);



//This Header is used to make data download instead of display the data
 header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=".$setExcelName."_report-".$timestamp.".xls");

header("Pragma: no-cache");
header("Expires: 0");

//It will print all the Table row as Excel file row with selected column name as header.
echo ucwords($setMainHeader)."\n".$setData."\n";
?>
