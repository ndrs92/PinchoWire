<?php
include_once "../controller/pincho_controller.php";
session_start();
if(!empty($_SESSION["user"])){
	header("Location: list.php");
} 
?>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Registrar Jurado Popular </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>
</head>
<body>
	<h1>Registrar Jurado Popular </h1>

	<form action="../controller/register_controller.php" method="POST" enctype="multipart/form-data">
		Nombre: <input type="text" name="nombre" /><br/>
		email: <input type="email" name="idemail" /><br/>
		Contraseña: <input type="password" name="contrasena" /><br/>
		Repite tu contraseña: <input type="password" name="contrasena_verif" /><br/>
		Avatar: <input type="file" name="rutaavatar" id="rutaavatar"/><br/>
		<input type="submit" value="Crear usuario" name="submit"/><br/>
	</form>

</body>
</html>