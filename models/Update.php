<?php

require_once 'DBConnection.php';
require_once 'Retrieve.php';
require_once 'Sessions.php';

class Update
{
	private $conn;
	private $msg;

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

	public function addTimeout()
	{
		date_default_timezone_set("Asia/Karachi");
		$day = date('d-m-y');
		$time = date('H:i');

		$retrieve = new Retrieve();

		if($retrieve->timeOut($day)) {
			$session = new Sessions();
			$id = $session->getSession();

			$sql = "UPDATE Attendance
					SET  time_out = '$time'
					WHERE emp_id = $id  AND day = '$day' AND time_out IS NULL;";

			if($this->conn->query($sql))
				$this->msg = "Time Out Successful";
			else
				$this->msg = "Time Out Unsuccessful";
		} else {
			$this->msg = "You have Already Time Out";
		}
	}

	public function updateEmp($id, $name, $email, $salary, $password, $dept, $img, $boss, $desig)
	{
		$validate = new Validation();

		if(is_null($id))
			$this->msg = "Please Enter Employee ID";
		else if(!$validate->empValidation($name, $email, $salary, $password, $dept, $img['name'], $boss, $desig))
			$this->msg = $validate->getMessage();
		else {
			$img_name = "NULL";
			if($img['name']) {

				if(file_exists("../views/images/p-$email.jgp"))
					unlink("../views/images/p-$email.jgp");

				if(file_exists("../views/images/p-$email.png"))
					unlink("../views/images/p-$email.png");

				if(file_exists("../views/images/p-$email.png"))
					unlink("../views/images/p-$email.png");

				$img_name = "p-" . $email . "." . pathinfo($img['name'] , PATHINFO_EXTENSION);
				$path = "../views/images/" . $img_name;
				move_uploaded_file($img['tmp_name'], $path);
				$password = crypt($password, "mysalt123");

				$sql = "UPDATE Employees 
						SET emp_name = '$name', emp_email = '$email', emp_salary = $salary, emp_img = '$img_name', emp_password = '$password', dept_id = $dept, desig_id = $desig, boss_id = $boss
						WHERE emp_id = $id";
			} else {
				$sql = "UPDATE Employees 
						SET emp_name = '$name', emp_email = '$email', emp_salary = $salary, emp_password = '$password', dept_id = $dept, desig_id = $desig, boss_id = $boss
						WHERE emp_id = $id";
			}

			if($this->conn->query($sql))
				$this->msg = "Updation Successful";
			else
				$this->msg = "Updation Unsuccessful";
		}
	}
}