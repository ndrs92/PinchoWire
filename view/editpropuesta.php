<?php

//Super duper helper codes
include_once "../resources/code/lang_coverage.php";
include_once "../model/establecimiento.php";

session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> <?= $l["view_editpropuesta_editpropuesta"] ?> </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>
</head>
<body>
	<?php
		$row = $_SESSION["user"]->havePropuesta();
		if(!empty($row) && $row["estadoPropuesta"] == 0){
	?>
	<h1><?= $l["view_editpropuesta_titulo"] ?> </h1>
	<form action="../controller/editpropuesta_controller.php" method="POST">
		<?= $l["view_editpropuesta_intronombre"] ?><input type="text" name="editpropuesta_propuesta_nombre" value="<?= $row['idnombre']; ?>" />
		<br/>
		<?= $l["view_editpropuesta_introdescripcion"] ?><textarea name="editpropuesta_propuesta_descripcion" row="4" cols="50" ><?= $row['descripcion']; ?></textarea>
		<br/>
		<?= $l["view_editpropuesta_introingredientes"] ?><textarea name="editpropuesta_propuesta_ingredientes" row="4" cols="50" ><?= $row['ingredientes']; ?></textarea>
		<br/>	
		<?= $l["view_editpropuesta_introprecio"] ?><input type="text" name="editpropuesta_propuesta_precio" value="<?= $row['precio']; ?>" />
		<br/>
		<input type="submit" name="editpropuesta_propuesta_enviar" value="<?= $l["view_editpropuesta_enviar"] ?>" />
	</form>
	<?php 
		}else{
			echo "No tiene una propuesta, por lo que no se puede editar o su propuesta ya ha sido validada<br/>";
			echo "<a href='./list.php'>Volver a pagina principal</a>";
		}
	?>
</body>
</html>