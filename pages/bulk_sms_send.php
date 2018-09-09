<?php
$district_id = $_SESSION['getin_district'];
$district = DB::getInstance()->getName('core_district', $district_id, 'name', 'id');
$array_numbers = array();
$messages = DB::getInstance()->getName("messages",1,"Message","Message_Id");
echo $messages;
$scheduled = DB::getInstance()->query("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id and cp.district LIKE '".$district."'");
foreach ($scheduled->results() as $scheduled) {
    $date_due_on = $scheduled->due_on;
    $new_date = addDaysToDate(0, $date_due_on);
    $date_today = date("Y-m-d");
    $compare_date = addDaysToDate(3, $date_today);
    //echo $date_due_on."<br/>";
    if ($new_date == $compare_date) {
        array_push($array_numbers, $scheduled->pnumber);
    } else {
        //array_push($array_numbers, $scheduled->pnumber);
    }
}
if(!empty($array_numbers)){
  $numbers_to_send=  implode(",", $array_numbers);
  send_sms($numbers_to_send, $messages);
}




