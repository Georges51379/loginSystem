<?php
session_start();
include("db/connection.php");
$_SESSION["loginSystem-email"]=="";
date_default_timezone_set('Asia/Beirut');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE userlog  SET logoutTime = '$ldate' WHERE userEmail = '".$_SESSION["loginSystem-email"]."' ORDER BY id DESC LIMIT 1");
header('location: index.php');
?>
