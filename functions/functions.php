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
include('classes/AfricasTalkingGateway.php');

function send_sms($phone, $message) {
    $sender = "UNFPA - GetIn Project";
    $recipients = $phone;
    $username = $_SERVER['AIT_USER'];
    $apikey = $_SERVER['AIT_KEY'];
    // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    $sms_result = FALSE;
    try{
        $results = $gateway->sendMessage($recipients, $message);
        $sms_result = TRUE;
    }
    catch ( AfricasTalkingGatewayException $e )
    {
        echo "Encountered an error while sending: ".$e->getMessage();
    }
    return $sms_result;
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
/*
 * Calculates the beginning and end dates for a range of years.
 *
 *  $minAge The minumum age in the range as an interval string       
 *  $upperBound The maximum age in the range as an interval string(default: value of $minAge)
 *  $fromDate A string or DateTime object to calculate the range from(default: current date and time) 
 *
 * Returns an array of two string as the beginning and end of the range.
 */
function ageRange( $minAge, $maxAge=NULL, $fromDate=NULL){
    $immutable = NULL;
    $fromImmutable = NULL;
    if(!empty($fromDate)){
        if($fromDate instanceof DateTimeInterface){
            $fromImmutable = date_create_immutable_from_format('Y-m-d H:i:s',$fromDate->format('Y-m-d H:i:s'));
        } else {
            $fromImmutable = date_create_immutable_from_format('Y-m-d H:i:s', $fromDate);
        }
    } else {
        $fromImmutable = date_create_immutable("now");
    }
    $range = array();
    $maxAge = (!empty($maxAge))? $maxAge: $minAge;
    $startDate = $fromImmutable->sub(date_interval_create_from_date_string($maxAge));
    $endDate = $fromImmutable->sub(date_interval_create_from_date_string($minAge));
    return array($startDate->format('Y-m-d H:i:s'), $endDate->format('Y-m-d H:i:s'));    
}


/* 
 * Convert a role value string to label that should be displayed.
 */
function roleToViewStr($role){
    $label = NULL;
    if(!empty($role)){
        switch($role){
            case "vht":
                $label = "CHEW";
                break;
            default:
                $label = $role;
        }
    }
    return $label;
}

/* 
 * Convert a role label string to value that is persisted.
 */
function roleFromViewStr($viewStr){
    $value = NULL;
    if(!empty($viewStr)){
        switch($viewStr){
            case "CHEW":
                $value = "vht";
                break;
            default:
                $value = $viewStr;
        }
    }
    return strtolower($value);
}

function quoteStr($input, $quoteChar="'"){
    return "$quoteChar".$input."$quoteChar";
}

function html($value, $element=NULL, $attributes=[]){
    $safeStr = "";
    $safeArr = array();
    if (is_array($value)){
        $element = "pre";
        foreach($value as $k => $v){
            $safeArr[] = "    $k => '$v'";
        }
        $safeArr[] ="</pre>";
    } else if (is_object($value)){
        if(in_array("__toString", get_class_methods($value))){
            $safeArr[] = strval($value->__toString());
        } else {
            $safeArr[] = strval($value);
        }
    } else{
        $safeStr = strval($value);
    }
    $safeStr = (!empty($element))? "<$element>".implode(" ", $safeArr)."</$element>":"<div>".implode(" ", $safeArr)."</div>" ;
    return $safeStr;

}

function htmlselect($arr, $selected=NULL, $attrs=array()){
        foreach($attrs as $key => $val){
        }
        $safeArr = array("<select name=\"\" id=\"\">");
        foreach($arr as $key => $val){
            $selected = ($key == $selected)? "selected":""; 
            $safeArr[] = "<option value=\"$key\" $selected>$group</option>";
        }
        $safeArr[] = "</select>";
        return implode("\n",$safeArr);
}

function htmlp($value){
    return html($value, "p");
}

?>
