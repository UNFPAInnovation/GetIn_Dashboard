<?php
$identifier = Input::get('identifier');
$messages = Input::get("messages");
if ($identifier == 'Missed Appointment'):
    echo send_sms("0700393643",$messages);
redirect("People Who Missed Appointments received reminders", "index.php?page=broadcast_message");
elseif ($identifier == 'Visit Reminder'):
    echo "Sending Message";
    $scheduled = DB::getInstance()->query("SELECT cp.*,tt.* FROM tasks_task tt, tasks_encountertask tet,core_subject cs,core_patients cp where tt.id=task_ptr_id and tet.subject_id=cs.uuid and cs.id=cp.subject_ptr_id");
    foreach ($scheduled->results() as $scheduled) {
        send_sms($scheduled->pnumber,$messages);
    }
    redirect("Visit Reminder Sent Successfully", "index.php?page=broadcast_message");
else:
    redirect("No Category Matching Criteria", "index.php?page=broadcast_message");
endif;