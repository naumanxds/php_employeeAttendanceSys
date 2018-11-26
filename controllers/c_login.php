<?php

require_once '../models/Sessions.php';
require_once '../models/Retrieve.php';

$session = new Sessions();

if (!isset($_POST['loginForm'])){
	header('location:../views/login.php');
	die();
}

$usr_email = $_POST['usr_email'];
$usr_password = $_POST['usr_password'];

$retrieve = new Retrieve();
$result = $retrieve->loginCheck($usr_email, crypt($usr_password, "mysalt123"))->fetch_assoc();

$session = new Sessions();

if($result) {
	$session->startSession($result['emp_id'], $result['desig_id']);
}

if($session->getRestriction())
	header('location:../views/addEmployee.php');

if($session->getSession())
	header('location:../views/markAttendance.php');

header("location:../views/login.php?msg=Wrong Email / Password");
