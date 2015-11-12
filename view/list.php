<?php
include_once "../controller/pincho_controller.php";
?>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Lista de Pinchos </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>

</head>
<body>
	<h1>PinchoWire</h1>
	<a href="./login.php">Identificarse</a><br>
	<a href="./register_user.php">Registrarse (Usuario)</a><br>
	<a href="./register_establishment.php">Registrarse (Establecimiento)</a><br>

	<h1>Lista de Pinchos </h1>
	<table border="1">
		<thead>
			<td>Nombre</td>
			<td>Descripción</td>
			<td>Precio</td>
			<td>Ingredientes</td>
		</thead>
		<tbody>
			<?php
			foreach(getAllPinchos() as $pincho){
				echo "
				<tr>
					<td><a href='viewPincho.php?id=".$pincho->getIdnombre()."'  >".$pincho->getIdnombre()."</a></td>
					<td>".$pincho->getDescripcion()."</td>
					<td>".$pincho->getPrecio()."</td>
					<td>".$pincho->getIngredientes()."</td>
				</tr>
				";
			}
			?>
		</tbody>
	</table>

</body>
</html>
