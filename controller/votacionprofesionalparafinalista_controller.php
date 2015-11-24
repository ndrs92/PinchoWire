<?php

	include_once "../model/juradoprofesional.php";
	
	if (!isset($_SESSION)) session_start();
	if (get_class($_SESSION["user"]) != "JuradoProfesional") {
    	header("Location: ../view/403.php");
    	exit;
	}

	if ($_POST["pincho"] && $_POST["puntuacion"]){
		$return = $_SESSION["user"]->votacionPromociona($_POST["pincho"], $_POST["puntuacion"] );
		if($return){
			header("Location: ../view/view_votacionprofesional.php");
		}
		else{
			echo "Error BD votacionprofesionalparafinalista_controller.php";
		}
	}


?>