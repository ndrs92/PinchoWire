<?php

	include_once "../model/juradoprofesional.php";
	include_once "../controller/concurso_controller.php";
	
	if (!isset($_SESSION)) session_start();
	$concurso = getConcurso();
	if (get_class($_SESSION["user"]) != "JuradoProfesional" || $concurso->getEstado() != 1 ) {
    	header("Location: ../view/403.php");
    	exit;
	}

	if ($_POST["pincho"] && $_POST["puntuacion"]){
		$return = $_SESSION["user"]->votacionFinalista($_POST["pincho"], $_POST["puntuacion"] );
		if($return){
			header("Location: ../view/view_votacionprofesionalfinal.php");
		}
		else{
			echo "Error BD votacionprofesionalparaganador_controller.php";
		}
	}


?>