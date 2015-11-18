<?php
include_once "../controller/pincho_controller.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";
session_start();
if(get_class($_SESSION["user"])!="Administrador"){
	header("Location: 403.php");
	exit;
}
?>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Administración </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>

</head>
<body>
	<h1>Administración del Concurso</h1>
	<a href="view_admin_usuarios.php"> Administrar Usuarios </a><br/>
	<a href="view_admin_propuestas.php"> Administrar Propuestas de Pinchos </a><br/>
</body>
</html>
