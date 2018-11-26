<?php

require_once '../models/Sessions.php';
session_start();

$session = new Sessions();
$session->logoutUser();

header('location:../views/login.php');
