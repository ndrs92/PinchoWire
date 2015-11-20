<?php

	include_once "../model/establecimiento.php";

session_start();
if(get_class($_SESSION["user"])!="Establecimiento"){
	header("Location: ../view/403.php");
	exit;
}

if($_POST["enviarpropuesta_propuesta_nombre"] && $_POST["enviarpropuesta_propuesta_descripcion"] && $_POST["enviarpropuesta_propuesta_ingredientes"] && $_POST["enviarpropuesta_propuesta_precio"] && $_POST["enviarpropuesta_propuesta_rutaimagen"]){

	
	$resultado = $_SESSION["user"]->enviar_propuesta($_POST["enviarpropuesta_propuesta_nombre"], $_POST["enviarpropuesta_propuesta_descripcion"], $_POST["enviarpropuesta_propuesta_ingredientes"], $_POST["enviarpropuesta_propuesta_precio"], $_POST["enviarpropuesta_propuesta_rutaimagen"]);
	if($resultado){
		echo "guardado satisfactorio <br/>";
	}
	else{
		echo "error en guardado <br/>";			
	}
	echo "<a href='../view/list.php'>Volver a pagina principal</a><br/>";


}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	header("Location: ../view/404.php");
    exit();//echo "you should not end here. Check javascript form verification";
}

?>