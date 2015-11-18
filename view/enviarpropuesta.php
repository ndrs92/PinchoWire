<?php

//Super duper helper codes
include_once "../resources/code/lang_coverage.php";

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> <?= $l["view_enviarpropuesta_enviarpropuesta"] ?> </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>
</head>
<body>
	<h1><?= $l["view_enviarpropuesta_titulo"] ?> </h1>
	<form action="../controller/enviarpropuesta_controller.php" method="POST">
		<?= $l["view_enviarpropuesta_intronombre"] ?><input type="text" name="enviarpropuesta_propuesta_nombre" placeholder="<?= $l["view_enviarpropuesta_intronombre_placeholder"] ?>" />
		<br/>
		<?= $l["view_enviarpropuesta_introdescripcion"] ?><textarea name="enviarpropuesta_propuesta_descripcion" row="4" cols="50" placeholder="<?= $l["view_enviarpropuesta_introdescripcion_placeholder"] ?>"></textarea>
		<br/>
		<?= $l["view_enviarpropuesta_introingredientes"] ?><textarea name="enviarpropuesta_propuesta_ingredientes" row="4" cols="50" placeholder="<?= $l["view_enviarpropuesta_introingredientes_placeholder"] ?>"></textarea>
		<br/>	
		<?= $l["view_enviarpropuesta_introprecio"] ?><input type="text" name="enviarpropuesta_propuesta_precio" placeholder="<?= $l["view_enviarpropuesta_introprecio_placeholder"] ?>" />
		<br/>
		<input type="submit" name="enviarpropuesta_propuesta_enviar" value="<?= $l["view_enviarpropuesta_enviar"] ?>" />
	</form>
</body>
</html>
<!-- 
idnombre
descripcion
precio
ingredientes
ganadorPopular
estadopropuesta
	- 0: propuesta enviada
	- 1: propuesta denegada
	- 2: propuesta aceptada(pincho que participa)
-->