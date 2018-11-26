<?php

session_start();
require_once '../models/Sessions.php';
require_once '../models/Update.php';
require_once '../models/Create.php';

$session = new Sessions();

if(!$session->getSession())
	header('location:login.php?err=Please Login');

if(!isset($_GET['time_in']) && !isset($_GET['time_out'])) {
	header('location:../views/markAttendance.php?msg=Please Mark Attendance');
}  else if(isset($_GET['time_in'])) {
	$create = new Create();
	$create->addTimeIn();
	$msg = $create->getMessage();

	header("location:../views/markAttendance.php?msg=$msg");
} else {
	$update = new Update();
	$update->addTimeOut();
	$msg = $update->getMessage();

	header("location:../views/markAttendance.php?msg=$msg");
}
