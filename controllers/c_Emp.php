<?php

session_start();
require_once '../models/Create.php';
require_once '../models/Sessions.php';
require_once '../models/Update.php';

$session = new Sessions();

if(!$session->getSession())
	header('location:login.php?err=Please Login');

if(!$session->getRestriction())
	header('location:markAttendance.php');

$id = isset($_POST['emp_id']) ? $_POST['emp_id'] : null;
$name = isset($_POST['emp_name']) ? $_POST['emp_name'] : null;
$email = isset($_POST['emp_email']) ? $_POST['emp_email'] : null;
$salary = isset($_POST['emp_salary']) ? $_POST['emp_salary'] : null;
$password = isset($_POST['emp_password']) ? $_POST['emp_password'] : null;
$dept = isset($_POST['emp_dept']) ? $_POST['emp_dept'] : null;
$img = isset($_FILES['emp_img']['name']) ? $_FILES['emp_img'] : null;
$boss = isset($_POST['emp_boss']) ? $_POST['emp_boss'] : null;
$desig = isset($_POST['emp_desig']) ? $_POST['emp_desig'] : null;

if(isset($_POST['addEmpBtn'])){
	$create = new Create();
	$create->createEmp($name, $email, $salary, $password, $dept, $img, $boss, $desig);
	$msg = $create->getMessage();
	header("location:../views/addEmployee.php?msg=$msg");
} else if(isset($_POST['editEmpBtn'])) {
	$update = new Update();
	$update->updateEmp($id, $name, $email, $salary, $password, $dept, $img, $boss, $desig);
	$msg = $update->getMessage();
	header("location:../views/employeeList.php?msg=$msg");
} else {
	header("location:../views/addEmployee.php");
}
