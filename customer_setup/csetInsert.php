<?php   

include("../DBconfig.php");


	$fID=mysqli_real_escape_string($con, $_POST['fID']);
	$customerName=mysqli_real_escape_string($con, $_POST['customerName']);
	$customerMobile=mysqli_real_escape_string($con, $_POST['customerMobile']);
	$customerAddress=mysqli_real_escape_string($con, $_POST['customerAddress']);
	$oldAmount=mysqli_real_escape_string($con, $_POST['oldAmount']);


	$query1 = "SELECT * FROM `customer_setup` WHERE `customer_name`='$customerName' AND `customer_address`='$customerAddress'";
	$q1 = mysqli_query($con, $query1);
	

	if(mysqli_num_rows($q1) > 0){
		$arr = array('status' => 'error', 'message' => 'Cannot Add same name and address');
	}else{
		$query="INSERT INTO `customer_setup` (`id`,`customer_name`,`customer_mobile`,`customer_address`,`old_amount`) VALUES ('$fID','$customerName','$customerMobile','$customerAddress','$oldAmount')";
		mysqli_query($con, $query);
	
		$arr = array('status' => 'success', 'message' => 'Add cart Successfull');
	}
	echo json_encode($arr);


	

?>
