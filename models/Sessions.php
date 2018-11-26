<?php

class Sessions
{
	public function startSession($id=false, $desig=false)
	{
		session_start();
		$_SESSION['emp_id'] = $id;

		if($desig == 3)
			$_SESSION['hr'] = true;
	}

	public function getSession()
	{
		if(isset($_SESSION['emp_id']))
			return $_SESSION['emp_id'];

		return false;
	}

	public function getRestriction()
	{
		if(isset($_SESSION['hr']))
			return $_SESSION['hr'];

		return false;
	}

	public function logoutUser()
	{
		session_unset();
		session_destroy();
	}
}