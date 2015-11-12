<?php
include_once "../controller/pincho_controller.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";
session_start();

$allUsers = Usuario::getAllUsuarios();

?>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Administración de Usuarios</title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>

</head>
<body>
	<h1>Administración de Usuarios</h1>
	<table border="1">
		<thead>
		<td>Email</td>
		<td>Nombre</td>
		<td>Tipo de Usuario</td>
		<td>Acciones</td>
		</thead>
		<tbody>
		<?php
		foreach($allUsers as $user){
			echo "<tr>";
			echo "<td>".$user->getIdemail()."</td>";
			echo "<td>".$user->getNombre()."</td>";
			echo "<td>".get_class($user)."</td>";
			echo "<td></td>";
			echo "</tr>";
		}
		?>
		</tbody>

	</table>

</body>
</html>
