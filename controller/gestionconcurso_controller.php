<?php
	include_once("../model/concursoMapper.php");
	include_once("../model/administrador.php");
session_start();
if(get_class($_SESSION["user"])!="Administrador"){
	header("Location: ../view/403.php");
	exit;
}
if($_POST["nombre"] && $_POST["descripcion"] ){
	
	$resultado = concursoMapper::updateConcurso($_POST["nombre"], $_POST ["descripcion"]);
	if($resultado){
		echo "Se ha modificado correctamente<br/>";
	}
	else{
		echo "Error al guardar la modificación <br/>";			
	}
	header("Location: ../view/view_admin_concurso.php");


}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	header("Location: ../view/404.php");
    exit();//echo "you should not end here. Check javascript form verification";
}
?>