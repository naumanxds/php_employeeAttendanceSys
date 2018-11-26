<?php

class Validation
{
	private $flag = true;
	public $msg = '';

	public function __construct()
	{
		$this->flag = true;
		$this->msg = '';
	}

	public function getMessage()
	{
		return $this->msg;
	}

	public function empValidation($name = null, $email = null, $salary = null, $password = null, $dept = null, $img = null, $boss = null, $desig = null)
	{
		if(!$name){
			$this->msg = "Name Cant Be Empty";
			$this->flag = false;
		}

		if(!$email) {
			$this->msg .= "-Email Cant Be Empty";
			$this->flag = false;
		}

		if(!$salary || !filter_var($salary, FILTER_VALIDATE_INT)) {
			$this->msg .= "-Salary Cant Be Empty And Should Only Be Number";
			$this->flag = false;
		}

		if(!$password) {
			$this->msg .= "-Password Cant Be Empty";
			$this->flag = false;
		}

		if(!$dept || !filter_var($dept, FILTER_VALIDATE_INT)) {
			$this->msg .= "-Department Cant Be Empty And Should Only Be Number";
			$this->flag = false;
		}

		if(!$desig || !filter_var($desig, FILTER_VALIDATE_INT)) {
			$this->msg .= "-Designation Cant Be Empty And Should Only Be Number";
			$this->flag = false;
		}

		if($img) {
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
			if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg'){
				$this->msg .= "-Uploaded Image is Not in Corrent Format";
				$this->flag = false;
			}
		}

		return $this->flag;
	}
}