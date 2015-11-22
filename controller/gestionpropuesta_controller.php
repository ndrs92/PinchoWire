<?php
include_once "../model/pincho.php";
include_once "../model/administrador.php";

if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"])!="Administrador"){
	header("Location: ../view/403.php");
	exit;
}


$_GET["action"]($_GET["idnombre"]);

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$relpath = '../view/view_admin_propuestas.php'; 

header("Location: http://$host$uri/$relpath");

function accept_pincho($idnombre){

	$target = Pincho::getByIdnombre($idnombre);
	$target->setEstadopropuesta(2);
	
}

function deny_pincho($idnombre){
	$target = Pincho::getByIdnombre($idnombre);
	$target->setEstadopropuesta(1);
	
}

function set_pendant($idnombre){
	$target = Pincho::getByIdnombre($idnombre);
	$target->setEstadopropuesta(0);
	
}