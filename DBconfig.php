<?php
session_start();
$hostName="localhost";
$userName="root";
$password="";
$dbName="test_ali";

/********* Create Connecton *************/

$con = mysqli_connect($hostName,$userName,$password,$dbName) or die("Connection failed");
date_default_timezone_set("Asia/Muscat");

$id=$_SESSION['id'];
if(!isset($_SESSION['id'])){
  
}else{
    $Query="SELECT *FROM `accounts` WHERE `id`='$id'";
    $result=mysqli_query($con, $Query);
    $row=mysqli_fetch_assoc($result);
    $user=$row['id'];
    $username=$row['first_name'];
    $lastLogin=$row['last_login'];

    $time1 = time();
    $updateQuery="UPDATE `accounts` SET `last_login`='$time1' WHERE `id`='$id'";
    $updateResult=mysqli_query($con, $updateQuery);
}

?>

