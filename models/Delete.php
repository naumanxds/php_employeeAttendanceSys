<?php

require_once 'DBConnection.php';

class Delete
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
		$this->msg = null;
		$this->conn = null;
	}

	public function getMessage()
	{
		return $this->msg;
	}

	public function deleteEmp($emp_id)
	{
		if($this->deleteAtt($emp_id)) {
			$sql = "DELETE FROM `Employees` WHERE emp_id = $emp_id;";

			if($this->conn->query($sql))
				$this->msg = 'Deletion Successful';
			else
				$this->msg = 'Deletion Unsuccessful';
		} else {
			$this->msg = 'Deletion Unsuccessful';
		}

	}

	public function deleteAtt($emp_id)
	{
		$sql = "DELETE FROM Attendance WHERE emp_id = $emp_id;";
		if($this->conn->query($sql))
			return true;
		else
			return false;
	}

}