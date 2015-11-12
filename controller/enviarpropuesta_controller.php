<?php

	include_once "../model/establecimiento.php";

session_start();

if($_POST["enviarpropuesta_propuesta_nombre"] && $_POST["enviarpropuesta_propuesta_descripcion"] && $_POST["enviarpropuesta_propuesta_ingredientes"] && $_POST["enviarpropuesta_propuesta_precio"]){

	
	$resultado = $_SESSION["user"]->enviar_propuesta($_POST["enviarpropuesta_propuesta_nombre"], $_POST["enviarpropuesta_propuesta_descripcion"], $_POST["enviarpropuesta_propuesta_ingredientes"], $_POST["enviarpropuesta_propuesta_precio"]);
	if($resultado){
		echo "guardado satisfactorio <br/>";
	}
	else{
		echo "error en guardado <br/>";			
	}
	echo "<a href='../view/list.php'>Volver a pagina principal</a><br/>";


}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	echo "you should not end here. Check javascript form verification";
}

?>