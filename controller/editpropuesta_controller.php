<?php

	include_once "../model/establecimiento.php";

if(!isset($_SESSION)) session_start();

if(get_class($_SESSION["user"])!="Establecimiento"){
	header("Location: ../view/403.php");
	exit;
}

if($_POST["editpropuesta_propuesta_nombre"] && $_POST["editpropuesta_propuesta_descripcion"] && $_POST["editpropuesta_propuesta_ingredientes"] && $_POST["editpropuesta_propuesta_precio"]){
	
	$resultado = $_SESSION["user"]->editar_propuesta($_POST["editpropuesta_propuesta_nombre"], $_POST["editpropuesta_propuesta_descripcion"], $_POST["editpropuesta_propuesta_ingredientes"], $_POST["editpropuesta_propuesta_precio"]);
	if($resultado){
		echo "Se ha modificado correctamente<br/>";
	}
	else{
		echo "Error al guardar la modificación <br/>";			
	}
	echo "<a href='../view/list.php'>Volver a pagina principal</a><br/>";
	header("Location: ../view/list.php");


}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	header("Location: ../view/404.php");
    exit();//echo "you should not end here. Check javascript form verification";
}

?>