<?php
session_start();
$userName = json_decode($_SESSION["user"])->Name;
if (isset($userName)) {
   $userName = 'Welcome, ' . $userName;
}
require_once("common.php");
session_destroy();
header("location: login.php");
?>