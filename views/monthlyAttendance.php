<?php
	session_start();
	
	require_once '../models/Sessions.php';
	require_once '../models/Retrieve.php';

	$session = new Sessions();

	if(!$session->getSession())
		header('location:login.php?err=Please Login');

	if(!$session->getRestriction())
		header('location:markAttendance.php');

	$msg = '';
	if(isset($_GET['msg']))
		$msg = $_GET['msg'];

	$retrieve = new Retrieve();
	$monthly = array();

	for($l = 1; $l <= 12; $l++)
	{
		$day = DateTime::createFromFormat('m', $l)->format('m');

		$result = $retrieve->monthlyCount($day);
		if($result) {
			foreach ($result as $key) {
				$monthly[DateTime::createFromFormat('m', $l)->format('M')][$key['att_status']] = $key['att_count'];
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HR | Monthly Attendance</title>

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
				<h1>Monthly Attendance</h1>
			</header>
		</section>
		<div class="row">
			<div class="col-40 sideBar">
				<ul>
					<li><a href="addEmployee.php">Add Employee</a></li>
					<li><a href="employeeList.php">Employee's List</a></li>
					<li><a href="dailyAttendance.php">Daily Attendance</a></li>
					<li class="selected"><a href="monthlyAttendance.php">Monthly Attendance</a></li>
					<li><a href="../controllers/c_logout.php" id="logoutBtn">LogOut</a></li>
				</ul>
			</div>

			<div class="col-60">
				<div class="row">
					<?foreach($monthly as $key => $value):?>
						<div class="col-20">
							<h3 class="text-center"><?=$key?></h3>
							<hr>
							<p>L : <?echo (isset($value['L'])) ? $value['L'] : '0'; ?></p>
							<p>A : <?echo (isset($value['A'])) ? $value['A'] : '0'; ?></p>
							<p>P : <?echo (isset($value['P'])) ? $value['P'] : '0'; ?></p>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
</body>