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

	date_default_timezone_set("Asia/Karachi");
	$day = date('d-m-y');
	$retrieve = new Retrieve();
	$result = $retrieve->retrieveAttendance($day);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>HR | Daily Attendance</title>

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
				<h1>Daily Attendance</h1>
			</header>
		</section>
		<div class="row">
			<div class="col-40 sideBar">
				<ul>
					<li><a href="addEmployee.php">Add Employee</a></li>
					<li><a href="employeeList.php">Employee's List</a></li>
					<li class="selected"><a href="#">Daily Attendance</a></li>
					<li><a href="monthlyAttendance.php">Monthly Attendance</a></li>
					<li><a href="../controllers/c_logout.php" id="logoutBtn">LogOut</a></li>
				</ul>
			</div>

			<div class="col-60">
				<table>
					<tbody>
						<?if($result):?>
							<?foreach($result as $key):?>
								<tr>
									<td><?=$key['emp_name']?></td>
									<td><?=$key['att_status']?></td>
								</tr>
							<?endforeach;?>
						<?endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>