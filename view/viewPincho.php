<?php
include_once "../controller/pincho_controller.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";

session_start();
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
	
	<?php
	if(get_class($_SESSION["user"]) == "JuradoPopular"){
		?>
		<h4>Insertar un comentario</h4>
		<form action="../controller/addcomment_controller.php" method="POST">
			<input type="hidden" name="addcomment_comment_idpincho" value="<?php echo $pinchoActual->getIdnombre(); ?>"/>
			<textarea name="addcomment_comment_name" ></textarea>
			<input type="submit" name="submit_button" value="Enviar Comentario" />
		</form>
		<?php
	}
	?>

	<table border="1">
		<thead>
			<?php
			if(get_class($_SESSION["user"]) == "JuradoPopular"){
				echo "<td>Acciones</td>";
			}
			?>
			
			<td>Autor</td>
			<td>Fecha</td>
			<td>Comentario</td>
		</thead>
		<tbody>
			<?php
			foreach(getAllComentarios($pinchoActual) as $comentario){
				echo "
				<tr>";
					if(get_class($_SESSION["user"]) == "JuradoPopular" && $_SESSION["user"]->getIdmail() == $comentario["juradopopular_idemail"]){
						echo "<td><a href='../controller/eliminarcomentario_controller.php'>Eliminar </a></td>";
					}else{
						if(get_class($_SESSION["user"]) == "JuradoPopular"){
							echo "<td></td>";
						}
					}
					
					
					echo "<td><a href='profile.php?idnombre=".$comentario["juradopopular_idemail"]."'  >".$comentario["juradopopular_idemail"]."</a></td>
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