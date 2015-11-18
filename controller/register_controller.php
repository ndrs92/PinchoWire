<?php

include_once "../model/juradopopular.php";
include_once "../model/establecimiento.php";

session_start();
if(empty($_GET["type"])){
	header("Location: ../view/404.php");
	exit;
}

if(!empty($_SESSION["user"])){
	header("Location: ../view/list.php");
}

$registerType = $_GET["type"];

if($registerType == "juradopopular"){
	
	

	$idemail = $_POST["idemail"];
	$nombre = $_POST["nombre"];
	$contrasena = $_POST["contrasena"];
	$contrasena_verif = $_POST["contrasena_verif"];
	$rutaavatar = $_POST["rutaavatar"];
	$baneado = "0";
	$userToAdd = new JuradoPopular($idemail, $nombre, $contrasena, $rutaavatar, $baneado);
	$userToAdd->registerUser();


	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	if($_SESSION){
		//if you're login
	}else{
		
		$relpath = '../view/list.php'; 
		
		header("Location: http://$host$uri/$relpath");

	}



}else{
	if($registerType == "establishment"){

		$idemail = $_POST["idemail"];
		$nombre = $_POST["nombre"];
		$contrasena = $_POST["contrasena"];
		$contrasena_verif = $_POST["contrasena_verif"];
		$direccion = $_POST["direccion"];
		$paginaweb = $_POST["paginaweb"];
		$horario = $_POST["horario"];
		$coordenadas = $_POST["coordenadas"];
		$rutaavatar = $_POST["rutaavatar"];
		$foto = $_POST["foto"];
		$baneado = "0";
		$userToAdd = new Establecimiento($idemail, $nombre, $contrasena, $rutaavatar, $direccion, $paginaweb, $horario, $foto, $coordenadas, $baneado);
		$userToAdd->registerUser();


		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

		if($_SESSION){
		//if you're login
		}else{

			$relpath = '../view/list.php'; 

			header("Location: http://$host$uri/$relpath");

		}
	}else{

		//error, you should not end here
	}
}



?>