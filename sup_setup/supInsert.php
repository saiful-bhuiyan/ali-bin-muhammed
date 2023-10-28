<?php   

include("../DBconfig.php");


	$fID=mysqli_real_escape_string($con, $_POST['fID']);
	$supName=mysqli_real_escape_string($con, $_POST['supName']);
	$companyName=mysqli_real_escape_string($con, $_POST['companyName']);
	$companyAddress=mysqli_real_escape_string($con, $_POST['companyAddress']);
	$mobileNumber=mysqli_real_escape_string($con, $_POST['mobileNumber']);
	$oldAmount=mysqli_real_escape_string($con, $_POST['oldAmount']);

	$query1 = "SELECT * FROM `supplier_setup` WHERE `sup_name`='$supName' AND `company_address`='$companyAddress'";
	$q1 = mysqli_query($con, $query1);

	if(mysqli_num_rows($q1) > 0){
		$arr = array('status' => 'error', 'message' => 'Cannot Add same name and address');
	}else{
		$query="insert into `supplier_setup`(`id`,`sup_name`,`mobile_no`,`company_name`,`company_address`,`old_amount`)values('$fID','$supName','$mobileNumber','$companyName','$companyAddress','$oldAmount')";
		$q=mysqli_query($con, $query);
	
		$arr = array('status' => 'success', 'message' => 'Add cart Successfull');
	}
	echo json_encode($arr);


?>
