<?php
include_once "../model/establecimiento.php";

session_start();

if(get_class($_SESSION["user"])!="Establecimiento"){
	header("Location: 403.php");
	exit;
}


$pinchoTarget = $_SESSION["user"]->getAssociatedPincho();

$availableCodes = $pinchoTarget->getAvailableCodes();
$retrievedCodes = $pinchoTarget->getRetrievedCodes();


?>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> Códigos de mi pincho </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>

</head>
<body>
	<h1>Códigos de mi pincho</h1>
	<h3>Pincho: <?= $pinchoTarget->getIdnombre(); ?></h3>
	<a href="../controller/code_generator_controller.php?idnombre=<?= $pinchoTarget->getIdnombre(); ?>">Generar 5 códigos más</a><br/><br/>

	<h4>Códigos disponibles sin canjear</h4>
	<table border="1">
		<thead>
			<td>Código</td>
		</thead>
		<tbody>
			<?php
			foreach($availableCodes as $fila){
				echo "<tr>";
				echo "<td>".$fila["idcodigo"]."</td>";
				echo "</tr>";
			}

			?>

		</tbody>

	</table>





	<h4>Códigos canjeados</h4>
	<table border="1">
		<thead>
			<td>Código</td>
			<td>Usuario</td>
		</thead>
		<tbody>

			<?php
			if(isset($retrievedCodes)){

				foreach($retrievedCodes as $fila){
					echo "<tr>";
					echo "<td>".$fila["codigo_idcodigo"]."</td>";
					echo "<td>".$fila["juradopopular_idemail"]."</td>";
					echo "</tr>";
				}
				
			}else{
				echo "No hay codigos canjeados";
			}

			?>
		</tbody>

	</table>

</body>
</html>
