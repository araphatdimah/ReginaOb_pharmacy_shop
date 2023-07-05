<?php
session_start();
unset($_SESSION['attendantPassword']);

header("location: login.php");

?>