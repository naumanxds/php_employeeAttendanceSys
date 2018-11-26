<?php

require_once '../models/Retrieve.php';
require_once '../models/Create.php';

date_default_timezone_set("Asia/Karachi");
$day = date('d-m-y');

$retrieve = new Retrieve();
$result = $retrieve->unMarked($day);

$create = new Create();

$body = "I tried to convince the following users to mark their attendance but looks like the dont wana. Screw them, Better do something about them >_<. I have already maked them Late\n";


foreach($result as $key){
	$create->markLate($key['emp_id']);
	$body .= $key['emp_name'] . "<br>";
}

$body .= "\n\nSincerely, \nCron Job Linux.";
mail("nauman.nasir@coeus-solutions.de", "Attendance Not Marked", $body);