<?php

require_once 'DBConnection.php';
require_once 'Sessions.php';

class Retrieve
{
	private $conn;

	public function __construct()
	{
		$this->conn = DBConnection::connect();
	}

	public function __destruct()
	{
		$this->conn = null;
	}

	public function retrieveDesignations()
	{
		$sql = "SELECT * FROM `Designation`";
		return $this->conn->query($sql);
	}

	public function retrieveDepartments()
	{
		$sql = "SELECT * FROM `Department`";
		return $this->conn->query($sql);
	}

	public function retrieveManagers()
	{
		$sql = "SELECT * FROM Employees WHERE desig_id = 2";
		return $this->conn->query($sql);
	}

	public function retrieveEmp($id = null, $email = null)
	{
		$sql = '';
		if($id)
			$sql = "SELECT * FROM Employees WHERE emp_id = $id;";
		else if($email)
			$sql = "SELECT * FROM Employees WHERE emp_email = '$email';";
		else
			$sql = "SELECT * FROM Employees";

		return $this->conn->query($sql);
	}

	public function timeIn($day)
	{
		$session = new Sessions();
		$id = $session->getSession();
		$sql = "SELECT * FROM Attendance WHERE emp_id = $id  AND day = '$day'";
		return $this->conn->query($sql)->fetch_assoc();
	}

	public function timeOut($day)
	{
		$session = new Sessions();
		$id = $session->getSession();
		$sql = "SELECT * FROM Attendance WHERE emp_id = $id  AND day = '$day' AND time_out IS NULL";
		return $this->conn->query($sql)->fetch_assoc();
	}

	public function retrieveAttendance($day, $id = null)
	{
		$sql = '';

		if($id)
			$sql = "SELECT * FROM Attendance WHERE emp_id = $id AND day LIKE '$day';";
		else
			$sql = "SELECT e.emp_name, a.att_status
					FROM Employees e INNER JOIN Attendance a
					WHERE e.emp_id = a.emp_id AND day LIKE '$day';";

		return $this->conn->query($sql);
	}

	public function monthlyCount($day) 
	{
		$sql = "SELECT  att_status, COUNT(att_status) as att_count
				FROM `Attendance` 
				WHERE day LIKE '%-$day-%'
				GROUP BY att_status
				ORDER By att_status";

		return $this->conn->query($sql);
	}

	public function loginCheck($email = null, $password = null)
	{
		$sql = "SELECT *
				FROM Employees
				WHERE emp_email = '$email' AND emp_password = '$password'";

		return $this->conn->query($sql);
	}

	public function unMarked($day)
	{
		$sql = "SELECT *
				FROM Employees
				WHERE emp_id NOT IN (
					SELECT emp_id
					FROM Attendance
					WHERE day = '$day' AND att_status IS NOT NULL);";

		return $this->conn->query($sql);
	}
}