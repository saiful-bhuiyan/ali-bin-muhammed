<?php
include("../DBconfig.php");
	$userName = $_POST['txtName'];
	$Password = $_POST['txtPassword'];

	$user = stripcslashes($userName);
	$pass = stripcslashes($Password);

	$user = mysqli_real_escape_string($con, $user);
	$pass = mysqli_real_escape_string($con, $pass);

	$loginQuery="SELECT *FROM `accounts` WHERE `userName`='$user' AND `password`='$pass' LIMIT 1";
	$result=mysqli_query($con, $loginQuery);

	if(mysqli_num_rows($result) > 0){
		$row=mysqli_fetch_assoc($result);
		$_SESSION['id'] = $row['id'];
		$arr = array('status' => 'success', 'message' => 'Login Successfull');
	}else{
		$arr = array('status' => 'error', 'message' => 'Invalid UserName or Password');
	}
	echo json_encode($arr);
?>