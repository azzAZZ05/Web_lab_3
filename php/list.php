<?php
session_start();
$num = htmlspecialchars($_POST['number']);
$let = htmlspecialchars($_POST['letter']);
$_SESSION['class'] = $num.'|'.$let;
header("location: ../classlist.php");
?>