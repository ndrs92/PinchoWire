<?php
include_once "../controller/pincho_controller.php";
?>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Registrar Establecimiento</title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>

</head>
<body>
	<h1>Registrar Establecimiento </h1>
	<form action="../controller/register_controller.php?type=establishment" method="POST">
		Nombre: <input type="text" name="nombre" /><br/>
		email: <input type="email" name="idemail" /><br/>
		Direccion: <input type="text" name="direccion" /><br/>
		Página Web: <input type="text" name="paginaweb" /><br/>
		Horario: <input type="text" name="horario" /><br/>
		Coordenadas del establecimiento: <input type="text" name="coordenadas" /><br/>
		Contraseña: <input type="password" name="contrasena" /><br/>
		Repite tu contraseña: <input type="password" name="contrasena_verif" /><br/>
		Fotografia: <input type="file" name="foto" /><br/>
		<input type="submit" value="Crear usuario" /><br/>
	</form>

</body>
</html>