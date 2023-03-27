<?php
session_start();
include("db/connection.php");
$_SESSION["ad-email"]=="";
header('location: index.php');
?>
