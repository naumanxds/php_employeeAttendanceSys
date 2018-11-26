<?php

require_once 'Retrieve.php';
require_once 'Sessions.php';
require_once 'Validation.php';


class Create
{
	private $conn;

	public function __construct()
	{
		$this->conn = DBConnection::connect();
		$this->msg = null;
	}

	public function __destruct()
	{
		$this->conn = null;
		$this->msg = null;
	}

	public function getMessage()
	{
		return $this->msg;
	}

	public function addTimeIn()
	{
		date_default_timezone_set("Asia/Karachi");
		$day = date('d-m-y');
		$time = date('H:i');
		
		$retrieve = new Retrieve();

		if(!$retrieve->timeIn($day)) {
			$session = new Sessions();
			$id = $session->getSession();
			$status = null;
			
			if($time < '11:00')
				$status = 'P';
			else if($time < '12:00')
				$status = 'L';
			else
				$status = 'A';

			$sql = "INSERT INTO Attendance (emp_id, att_status, time_in, day)
					VALUES ($id, '$status', '$time', '$day');";

			if($this->conn->query($sql))
				$this->msg = "Time In SuccessFul";
			else
				$this->msg = "Time In Unsuccessful";

		} else {
			$this->msg = "You have already Enter your Time In";
		}
	}

	public function markLate($id)
	{
		date_default_timezone_set("Asia/Karachi");
		$day = date('d-m-y');
		$time = date('H:i');
		
		$sql = "INSERT INTO Attendance (emp_id, att_status, time_in, day)
				VALUES ($id, 'A', '$time', '$day');";

		$this->conn->query($sql);
	}

	public function createEmp($name, $email, $salary, $password, $dept, $img, $boss, $desig)
	{
		$validate = new Validation();
		$retrieve = new Retrieve();

		if($retrieve->retrieveEmp(null, $email)->fetch_assoc())
			$this->msg = "Email Already Exists";
		else if(!$validate->empValidation($name, $email, $salary, $password, $dept, $img['name'], $boss, $desig))
			$this->msg = $validate->getMessage();
		else {
			$img_name = "NULL";

			if($img['name']) {
				$img_name = "p-" . $email . "." . pathinfo($img['name'] , PATHINFO_EXTENSION);
				$path = "../views/images/" . $img_name;
				move_uploaded_file($img['tmp_name'], $path);

				$sql = "INSERT INTO Employees (emp_name, emp_email, emp_salary, emp_img, emp_password, dept_id, desig_id, boss_id)
						VALUES('$name', '$email', $salary, '$img_name', '$password', $dept, $desig, $boss)";
			} else {
				$sql = "INSERT INTO Employees (emp_name, emp_email, emp_salary, emp_img, emp_password, dept_id, desig_id, boss_id)
						VALUES('$name', '$email', $salary, $img_name, '$password', $dept, $desig, $boss)";
			}			
			if($this->conn->query($sql))
				$this->msg = "New Employee Insertion Successful";
			else
				$this->msg = "! New Employee Insertion Unsuccessful";
		}
	}
}