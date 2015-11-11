<?php

	include_once "../model/establecimiento.php";
	include_once "../model/userMapper.php";
session_start();

if($_POST["enviarpropuesta_propuesta_nombre"] && $_POST["enviarpropuesta_propuesta_descripcion"] && $_POST["enviarpropuesta_propuesta_ingredientes"] && $_POST["enviarpropuesta_propuesta_precio"]){

	$fila = userMapper::getDatosEstablecimiento($_SESSION["user"]);

	$establecimiento = new Establecimiento($fila["idemail"], $fila["nombre"], $fila["contrasena"], $fila["rutaavatar"], $fila["direccion"], $fila["web"], $fila["horario"], $fila["rutaimagen"], $fila["geoloc"] );
	//$idemail, $nombre, $contrasena, $rutaavatar, $direccion, $web, $horario, $rutaimagen, $geoloc
	$establecimiento->enviar_propuesta($_POST["enviarpropuesta_propuesta_nombre"], $_POST["enviarpropuesta_propuesta_descripcion"], $_POST["enviarpropuesta_propuesta_ingredientes"], $_POST["enviarpropuesta_propuesta_precio"]);



}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	echo "you should not end here. Check javascript form verification";
}

?>