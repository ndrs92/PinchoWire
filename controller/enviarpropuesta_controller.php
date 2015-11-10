<?php

	include_once "../model/establecimiento.php";


if($_POST["enviarpropuesta_propuesta_nombre"] && $_POST["enviarpropuesta_propuesta_descripcion"] && $_POST["enviarpropuesta_propuesta_ingredientes"] && $_POST["enviarpropuesta_propuesta_precio"]){
	//Okey, all seems legit, proceed to log in
	
	Establecimiento::enviar_propuesta($_POST["enviarpropuesta_propuesta_nombre"], $_POST["enviarpropuesta_propuesta_descripcion"], $_POST["enviarpropuesta_propuesta_ingredientes"], $_POST["enviarpropuesta_propuesta_precio"]);


	//echo "Error: Login yet to be implemented. Sorry";

}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	echo "you should not end here. Check javascript form verification";
}

?>