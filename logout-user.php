<?php
session_start();
include("db/connection.php");
$_SESSION['email']=="";
date_default_timezone_set('Asia/Beirut');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE userlog  SET logoutTime = '$ldate' WHERE userEmail = '".$_SESSION['email']."' ORDER BY id DESC LIMIT 1");
session_unset();
session_destroy();
header('location: index.php');
?>
