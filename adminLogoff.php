<?php
session_start();
unset($_SESSION['adminPassword']);

header("location: login.php");

?>