<?php 
include("../scriptPHP/sessions.php");
session_start();
deconnection_session();
header("location: ../index.php");

?>
