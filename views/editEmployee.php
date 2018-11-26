<?php
	session_start();
	require_once '../models/Sessions.php';
	require_once '../models/Retrieve.php';

	$session = new Sessions();

	if(!$session->getSession())
		header('location:login.php?err=Please Login');

	if(!$session->getRestriction())
		header('location:markAttendance.php');

	if(!isset($_GET['emp_id']))
		header('location:employeeList.php?msg=Enter Employee Id');

	$msg = '';
	if(isset($_GET['msg']))
		$msg = $_GET['msg'];

	$retrieve = new Retrieve();
	$desig = $retrieve->retrieveDesignations();
	$dept = $retrieve->retrieveDepartments();
	$manager = $retrieve->retrieveManagers();
	$emp = $retrieve->retrieveEmp($_GET['emp_id'])->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HR | Edit Employee</title>

	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript">
		var msg = "<?=$msg?>";
		if(msg) {
			window.alert(msg);
		}
	</script>
</head>
<body>
	<div class="container">
		<section class="row text-center">
			<header>
				<h1>Edit Employee</h1>
			</header>
		</section>

		<div class="row">
			<div class="col-40">
				<img src="images/<?=$emp['emp_img']?>" width="100%" height="auto">
			</div>
			<div class="col-60">
				<form method="POST" action="../controllers/c_Emp.php"  enctype="multipart/form-data">
					<input type="hidden" name="emp_id" value="<?=$emp['emp_id']?>">
					<div class="row">
						<h3>Name</h3>
						<input type="text" name="emp_name" value="<?=$emp['emp_name'];?>" required="required">
					</div>
					<div class="row">
						<h3>Email</h3>
						<input type="email" name="emp_email" value="<?=$emp['emp_email'];?>" required="required">
					</div>
					<div class="row">
						<h3>Salary</h3>
						<input type="number" name="emp_salary" min="20000" value="<?=$emp['emp_salary'];?>" required="required">
					</div>
					<div class="row">
						<h3>Password</h3>
						<input type="password" name="emp_password" value="<?=$emp['emp_password'];?>" required="required">
					</div>
					<div class="row">
						<h3>Department</h3>
						<select name="emp_dept" required="required">
							<?foreach($dept as $key):?>
								<option value="<?=$key['dept_id'];?>"><?=$key['dept_name'];?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="row">
						<h3>Profile Picture</h3>
						<input type="file" name="emp_img">
					</div>
					<div class="row">
						<h3>Boss</h3>
						<select name="emp_boss">
							<option value="NULL">-- Select --</option>
							<?foreach($manager as $key):?>
								<option value="<?=$key['emp_id'];?>"><?=$key['emp_name'];?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="row">
						<h3>Designation:</h3>
						<select name="emp_desig" required="required">
							<?foreach($desig as $key):?>
								<option value="<?=$key['desig_id']?>"><?=$key['desig_name'];?></option>
							<?endforeach;?>
						</select>
					</div>
					<hr><br><br>

					<div class="row">
						<input type="submit" value="Update Employee" name="editEmpBtn">
					</div>
				</form>
				<a type="button" href="employeeList.php"><button type="button">Cancel</button></a>
			</div>
		</div>
	</div>
</body>
</html>