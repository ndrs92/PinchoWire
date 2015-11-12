<?php
include_once "../controller/pincho_controller.php";

$pinchoActual = getCurrentPincho($_GET["id"]);


?>

<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Pincho: <?php echo $pinchoActual->getIdnombre(); ?> </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>

</head>
<body>
	<h3>Nombre del pincho </h3>
	<p><?php echo $pinchoActual->getIdnombre(); ?></p>

	<h3>Descripción del pincho </h3>
	<p><?php echo $pinchoActual->getDescripcion(); ?></p>

	<h3>Precio del pincho </h3>
	<p><?php echo $pinchoActual->getPrecio(); ?></p>

	<h3>Ingredientes del pincho </h3>
	<p><?php echo $pinchoActual->getIngredientes(); ?></p>

	<h3>Comentarios al pincho: </h3>
	<table border="1">
		<thead>
			<td>ID Comentario</td>
			<td>Autor</td>
			<td>Fecha</td>
			<td>Comentario</td>
		</thead>
		<tbody>
			<?php
			foreach(getAllComentarios($pinchoActual) as $comentario){
				echo "
				<tr>
					<td>".$comentario["idcomentario"]."</td>
					<td><a href='profile.php?idnombre=".$comentario["juradopopular_idemail"]."'  >".$comentario["juradopopular_idemail"]."</a></td>
					<td>".$comentario["fecha"]."</td>
					<td>".$comentario["contenido"]."</td>
				</tr>
				";
			}
			?>
		</tbody>
	</table>
</body>
</html>