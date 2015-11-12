<?php

include_once "../model/juradopopular.php";
include_once "../model/establecimiento.php";

$registerType = $_GET["type"];

if($registerType == "user"){

	//verify all data is avaiable
	if(!$_POST["idemail"] || !$_POST["nombre"] || !$_POST["contrasena"] || !$_POST["rutaavatar"]){

		//error, introducir bien los datos
	}else{
	$idemail = $_POST["idemail"];
	$nombre = $_POST["nombre"];
	$contrasena = $_POST["contrasena"];
	$rutaavatar = $_POST["rutaavatar"];
	$userToAdd = new JuradoPopular($idemail, $nombre, $contrasena, $rutaavatar);

	$userToAdd->registerUser();

	}





}else{
	if($registerType == "establishment"){

		$userToAdd = new Establecimiento();

	}else{

		//error, you should not end here
	}
}



?>