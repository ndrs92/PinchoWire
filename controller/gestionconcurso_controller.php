<?php
include_once("../model/concursoMapper.php");
include_once("../model/administrador.php");
include_once "../resources/code/lang_coverage.php";

if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"])!="Administrador"){
	header("Location: ../view/403.php");
	exit;
}
if($_POST["nombre"] && $_POST["descripcion"] ){


	/* Validar avatar */
	$validUpload = 0;
	$rutaportada = "images/concurso/default.jpg";
	$from = $_FILES["rutaportada"];
	$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
	if (is_uploaded_file($from["tmp_name"])) {
		if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "bmp") {
			$validUpload = 1;
		}
	}


	$resultado = concursoMapper::updateConcurso($_POST["nombre"], $_POST ["descripcion"]);
	if ($validUpload == 1) {
		$from = $_FILES["rutaportada"]["tmp_name"];
		move_uploaded_file($from, "../images/title." . $imageFileType);
	}

	if($resultado){
		$_SESSION["alert"]["success"] = "alertify_contestManage_success";
	}
	else{
		$_SESSION["alert"]["error"] = "alertify_contestManage_error";
	}
	header("Location: ../view/view_admin_concurso.php");


}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	header("Location: ../view/404.php");
    exit();//echo "you should not end here. Check javascript form verification";
}
?>