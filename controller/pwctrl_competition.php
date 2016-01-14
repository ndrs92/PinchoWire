<?php

class CompetitionController{

	public static function assignPinchoAdmin(){
		if(!isset($_SESSION)) session_start();
		if(get_class($_SESSION["user"])!="Administrador"){
			header("Location: ../view/403.php");
			exit;
		}

		if($_POST["pincho"] && $_POST["asignar"]){
			$result = Usuario::assignPinchoJuradoProfesional( $_POST["asignar"], $_POST["pincho"]);
			if($result){
				header("Location: ../view/view_admin_asignar.php");
			}
			else{
				echo "Error al asignar el pincho";
			}
		}
		else{
			header("Location: ../view/404.php");
			exit();
		}
	}

	public static function generateCodes(){
		if(!isset($_SESSION)) session_start();

		if(get_class($_SESSION["user"])!="Establecimiento"){
			header("Location: ../view/403.php");
			exit;
		}

		$target = Pincho::getByIdnombre($_POST["idnombre"]);

		global $connectHandler;
		$connectHandler->autocommit(false);
		try {
			$target->createCodes($_POST["numCodes"]);
			$connectHandler->commit();
		}
		catch (Exception $e){
			$connectHandler->rollback();
		}
		$connectHandler->autocommit(true);
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

		$relpath = '../view/view_establishment_codes.php'; 

		header("Location: http://$host$uri/$relpath");
	}

	public static function changeState(){
		if(!isset($_SESSION)) session_start();


		$concurso = new Concurso();

		if(get_class($_SESSION["user"])!="Administrador" || $concurso->getEstado() == 3){
			header("Location: ../view/403.php");
			exit;
		}


		$estadoActual = $concurso->getEstado();

		$estadoActual++;
		switch($estadoActual){
			case 1:
			$concurso->setFinalistas($_POST["num"]);
			break;
			case 2:
			$num = $_POST["num"];
			$concurso->setGanadorProfesional($num);
			$concurso->setGanadorPopular($num);
			break;
		}

		$concurso->setEstado($estadoActual);

		header("Location: ../view/view_admin_concurso.php");


	}

	public static function getConcurso(){
		return new Concurso();
	}

	public static function editPropuesta(){
		if(!isset($_SESSION)) session_start();

		if(get_class($_SESSION["user"])!="Establecimiento"){
			header("Location: ../view/403.php");
			exit;
		}

		/* Validar fotografia */
		$rutaimagen = $_POST["imagen"];
		$validFormats = array("jpg", "jpeg", "png", "bmp");
		if (is_uploaded_file($_FILES["propuesta_imagen"]["tmp_name"])) {
			$from = $_FILES["propuesta_imagen"];
			$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
			if (in_array($imageFileType, $validFormats)) {
				$rutaimagen = "images/pinchos/" . $_POST["editpropuesta_propuesta_nombre"] . "." . $imageFileType;
				move_uploaded_file($from["tmp_name"], "../" . $rutaimagen);
			}
		}

		if($_POST["editpropuesta_propuesta_nombre"] && $_POST["editpropuesta_propuesta_descripcion"] && $_POST["editpropuesta_propuesta_ingredientes"] && $_POST["editpropuesta_propuesta_precio"]){
			
			$resultado = $_SESSION["user"]->editar_propuesta($_POST["editpropuesta_propuesta_nombre"], $_POST["editpropuesta_propuesta_descripcion"], $_POST["editpropuesta_propuesta_ingredientes"], $_POST["editpropuesta_propuesta_precio"], $rutaimagen);
			if($resultado){
				echo "Se ha modificado correctamente<br/>";
			}
			else{
				echo "Error al guardar la modificación <br/>";			
			}
			echo "<a href='../view/list.php'>Volver a pagina principal</a><br/>";
			header("Location: ../view/list.php");
		}else{
			header("Location: ../view/404.php");
			exit();
		}
	}

	public static function enviarPropuesta(){
		if (!isset($_SESSION)) session_start();
		if (get_class($_SESSION["user"]) != "Establecimiento") {
			header("Location: ../view/403.php");
			exit;
		}

		if ($_POST["enviarpropuesta_propuesta_nombre"] && $_POST["enviarpropuesta_propuesta_descripcion"] && $_POST["enviarpropuesta_propuesta_ingredientes"] && $_POST["enviarpropuesta_propuesta_precio"] && $_FILES["enviarpropuesta_propuesta_rutaimagen"]) {

			/* Validar imagen */
			$validUpload = 0;
			$validFormats = array("jpg", "jpeg", "png", "bmp");
			$rutaavatar = "images/pinchos/default.jpg";

			$from = $_FILES["enviarpropuesta_propuesta_rutaimagen"];
			$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
			if (is_uploaded_file($from["tmp_name"])) {
				if (in_array($imageFileType, $validFormats)) {
					$rutaimagen = "images/pinchos/" . $_POST["enviarpropuesta_propuesta_nombre"] . "." . $imageFileType;
					$validUpload = 1;
				}
			}

			$resultado = $_SESSION["user"]->enviar_propuesta($_POST["enviarpropuesta_propuesta_nombre"], $_POST["enviarpropuesta_propuesta_descripcion"], $_POST["enviarpropuesta_propuesta_ingredientes"], $_POST["enviarpropuesta_propuesta_precio"], $rutaimagen);
			if ($resultado) {
				move_uploaded_file($from["tmp_name"], "../" . $rutaimagen);
				echo "guardado satisfactorio <br/>";
			} else {
				echo "error en guardado <br/>";
			}
			echo "<a href='../view/list.php'>Volver a pagina principal</a><br/>";
			header("Location: ../view/list.php");

		} else {
			header("Location: ../view/404.php");
			exit();
		}
	}

	public static function gestionConcurso(){
		if (!isset($_SESSION)) session_start();
		if (get_class($_SESSION["user"]) != "Administrador") {
			header("Location: ../view/403.php");
			exit;
		}
		if ($_POST["nombre"] && $_POST["descripcion"]) {
			/* Validar avatar */
			$validUpload = 0;
			$rutaportada = "images/concurso/default.jpg";
			$from = $_FILES["rutaportada"];
			$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
			if (is_uploaded_file($from["tmp_name"])) {
				if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "bmp") {
					$validUpload = 1;
					$rutaportada = "images/concurso/portada." . $imageFileType;
				}
			}


			$resultado = concursoMapper::updateConcurso($_POST["nombre"], $_POST ["descripcion"], $rutaportada);
			if ($validUpload == 1) {
				move_uploaded_file($from["tmp_name"], "../" . $rutaportada);
			}

			if ($resultado) {
				echo "Se ha modificado correctamente<br/>";
			} else {
				echo "Error al guardar la modificación <br/>";
			}
			header("Location: ../view/view_admin_concurso.php");


			if ($resultado) {
				$_SESSION["alert"]["success"] = $l["alertify_contestManage_success"];
			} else {
				$_SESSION["alert"]["error"] = $l["alertify_contestManage_error"];
			}
			header("Location: ../view/view_admin_concurso.php");


		} else {

			header("Location: ../view/404.php");
			exit();
		}
	}

	public static function search($search_data){
		$toRet = array(
			"establishments" => "",
			"pinchos" => ""
			);

		$searchPinchos = Pincho::search($search_data);
		if($searchPinchos != NULL){
			foreach($searchPinchos as $p){
				$toRet["pinchos"][$p->getIdnombre()] = $p;
			}
		}

		$searchEstablishments = Establecimiento::search($search_data);
		if($searchEstablishments != NULL){
			foreach($searchEstablishments as $e){
				$toRet["establishments"][$e->getIdemail()] = $e;
			}
		}

		return $toRet;
	}

	function validate_pincho(){
		$idnombre = $_GET["idnombre"];
		$target = Pincho::getByIdnombre($idnombre);
		$target->setEstadopropuesta($_GET["estado"]);
		header("Location: ../view/view_admin_propuestas.php");

	}
}

?>