<?php

if(!isset($_SESSION)) session_start();

session_destroy();



$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$relpath = '../view/list.php'; 
header("Location: http://$host$uri/$relpath");

?>