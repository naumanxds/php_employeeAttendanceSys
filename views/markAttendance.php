<?php
	session_start();
	require_once '../models/Sessions.php';
	require_once '../models/Retrieve.php';

	$session = new Sessions();

	if(!$session->getSession())
		header('location:login.php?err=Please Login');

	if($session->getRestriction())
		header('location:addEmployee.php');

	$msg = '';
	if(isset($_GET['msg']))
		$msg = $_GET['msg'];

	date_default_timezone_set("Asia/Karachi");
	$retrieve = new Retrieve();
	$result = $retrieve->retrieveAttendance(date('d-m-y'), $session->getSession());

	if($result)
		$result = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mark Attendance</title>

	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript">
		var msg = "<?=$msg?>";
		if(msg) {
			window.alert(msg);
		}
	</script>
</head>
<body>
	<section class="container">
		<header class="row text-center">
			<h1>Mark Attendance</h1>
		</header>
	</section>

	<div class="row">
		<div class="col-40">&nbsp</div>
		<div class="col-20 blackBox">
			<div class="row">
				<form method="GET" action="../controllers/c_markAttendance.php">
					<input type="submit" value="Mark Time In" class="orangeBtn" name="time_in">
				</form>
				<br><br>
				<h3>Time In : <?=$result['time_in']?></h3>
			</div>
			<hr>
			<div class="row">
				<form method="GET" action="../controllers/c_markAttendance.php">
					<input type="submit" value="Mark Time Out" class="orangeBtn" name="time_out">
				</form>
				<br><br>
				<h3>Time Out : <?=$result['time_out']?></h3>
			</div>
			<hr>
			<div class="row">
				<a href="../controllers/c_logout.php" id="logoutBtn">Logout</a>
			</div>
		</div>
		<div class="col-40">&nbsp</div>
	</div>
</body>
</html>