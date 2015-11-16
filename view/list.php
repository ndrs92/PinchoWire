<?php
include_once "../controller/pincho_controller.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";
include_once "../resources/code/lang_coverage.php";

session_start();
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
	<?php
	if(!$_SESSION){
		?>
		<a href="./login.php"><?= $l["view_list_login"] ?></a><br>
		<a href="./register_user.php"><?= $l["view_list_register_user"] ?></a><br>
		<a href="./register_establishment.php"><?= $l["view_list_register_establishment"] ?></a><br>

		<?php
	}else{
		echo $l["view_list_welcome_comma"].$_SESSION["user"]->getNombre();
		echo "<br/>";
		if(get_class($_SESSION["user"]) == "Establecimiento"){
			if(!$_SESSION["user"]->havePinchoAccepted()){
				echo "<a href='enviarpropuesta.php'>".$l["view_list_send_proposal"]."</a><br/>";
				echo "<a href='editpropuesta.php'>".$l["view_list_edit_proposal"]."</a><br/>";
			}else{
				echo " - Tu pincho está concursando! <br/>";

				echo "<a href='./view_establishment_codes.php'>".$l["view_list_establishment_codes"]."</a><br/>";
				
			}
		}
		if(get_class($_SESSION["user"]) == "Administrador"){
			echo "<a href='./view_administrar.php'>".$l["view_list_admin_event"]."</a><br/>";
		}
		
		echo "<a href='profile.php?idemail=".$_SESSION['user']->getIdemail()."'>".$l["view_list_view_profile"]."</a><br/>";
		echo "<a href='../controller/logout_controller.php'>".$l["view_list_disconnect"]."</a><br/>";
	}
	?>

	<h1><?= $l["view_list_list_pinchos"] ?></h1>
	<table border="1">
		<thead>
			<td><?= $l["view_list_name"] ?></td>
			<td><?= $l["view_list_description"] ?></td>
			<td><?= $l["view_list_price"] ?></td>
			<td><?= $l["view_list_ingredients"] ?></td>
			<td><?= $l["view_list_eaten"]?></td>
		</thead>
		<tbody>
			<?php
			if (getAllPinchos() != NULL) {
				foreach (getAllPinchos() as $pincho) {
					
					if(isset($_SESSION["user"])){
						if(isProbado($pincho->getIdnombre(),$_SESSION["user"]->getIdemail())){
							$probado = $l["view_list_eaten"];
						}
						else{
							$probado = $l["view_list_not_eaten"];
						}
					}else{
						$probado = $l["view_list_eaten_not_logged"];
					}


					echo "
					<tr>
						<td><a href='viewPincho.php?id=" . $pincho->getIdnombre() . "'  >" . $pincho->getIdnombre() . "</a></td>
						<td>" . $pincho->getDescripcion() . "</td>
						<td>" . $pincho->getPrecio() . "</td>
						<td>" . $pincho->getIngredientes() . "</td>";

						
						if(isset($_SESSION["user"])){
							echo "<td><a href='../controller/markeatenpincho_controller.php?markeatenpincho_probado_idpincho=". $pincho->getIdnombre() . "&markeatenpincho_probado_idmail=" . $_SESSION["user"]->getIdemail() . "'>" . $probado . "</a></td>";
						}else{
							echo "<td>".$probado."</td>";	
						}

						echo "</tr>";

					}
				}
				?>
			</tbody>
		</table>

	</body>
	</html>
