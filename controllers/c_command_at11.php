<?php

require_once '../models/Retrieve.php';

date_default_timezone_set("Asia/Karachi");
$day = date('d-m-y');

$retrieve = new Retrieve();
$result = $retrieve->unMarked($day);

$body = "My Friend You Havent Marked Your Attendance and its already 11 am c'mon what are you doing. Better Hurry Up coz if you dont mark your Attendance till 12 pm I am gonna ping you Boss :3 \n\nSincerely,\n Cron Job Linux.";

foreach($result as $key)
	mail($key['emp_email'], "Attendance Notification", $body);
