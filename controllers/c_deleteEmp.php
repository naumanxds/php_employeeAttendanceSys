<?php

session_start();
require_once '../models/Sessions.php';
require_once '../models/Delete.php';
require_once '../models/Retrieve.php';

$session = new Sessions();

if(!$session->getSession())
	header('location:login.php?err=Please Login');

if(!$session->getRestriction())
	header('location:markAttendance.php');

if(!isset($_GET['emp_id']))
	header('location:../views/addEmployee.php?msg=! Please Enter Employee Id');

$retrieve = new Retrieve();

if(!$retrieve->retrieveEmp())
	header('location:../views/addEmployee.php?msg=! Employee Doesnt Exists');

$delete = new Delete();
$delete->deleteEmp($_GET['emp_id']);
$msg = $delete->getMessage();

header("location:../views/employeeList.php?msg=$msg");