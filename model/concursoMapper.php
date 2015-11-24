<?php
include_once("../resources/code/bd_manage.php");

class ConcursoMapper{

	public static function retrieveEstado(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select estado from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["estado"];
	}

	public static function retrieveFacebook(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select facebook from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["facebook"];
	}

	public static function retrieveTwitter(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select twitter from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["twitter"];
	}

	public static function retrieveGoogleplus(){
		global $connectHandler;
		$toRet = NULL;
		$query = "select googleplus from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["googleplus"];
	}

	public static function retrieveIdconcurso(){
		global $connectHandler;
		$query = "Select idconcurso from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["idconcurso"];

	}

	public static function retrieveDescripcion(){
		global $connectHandler;
		$query = "Select descripcion from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["descripcion"];

	}

	public static function retrieveFecha(){
		global $connectHandler;
		$query = "Select fecha from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["fecha"];

	}

	public static function retrieveRutaportada(){
		global $connectHandler;
		$query = "Select rutaportada from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["rutaportada"];

	}

	public static function retrieveTitulo(){
		global $connectHandler;
		$query = "Select titulo from concurso LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet["titulo"];
	}

	public static function retrieveNumPinchos(){
		global $connectHandler;
		$query = "select count(*) from pincho";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['count(*)'];
	}

	public static function retrieveNumUsers(){
		global $connectHandler;
		$query = "SELECT (SELECT COUNT(*) FROM juradopopular)+(SELECT COUNT(*) FROM juradoprofesional)+(SELECT COUNT(*) FROM establecimiento)+(SELECT COUNT(*) FROM administrador) AS cuenta";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['cuenta'];
	}

	public static function retrieveNumEstablecimientos(){
		global $connectHandler;
		$query = "SELECT COUNT(*) FROM establecimiento";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['COUNT(*)'];
	}

	public static function retrieveNumVotosPopulares(){
		global $connectHandler;
		$query = "SELECT COUNT(*) FROM vota";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['COUNT(*)'];
	}

	public static function retrieveNumComments(){
		global $connectHandler;
		$query = "SELECT COUNT(*) FROM comentario";
		$result = mysqli_query($connectHandler, $query);
		$toRet = mysqli_fetch_assoc($result);
		return $toRet['COUNT(*)'];
	}

	public static function updateEstado($newValue){
		global $connectHandler;
		$query = "UPDATE concurso SET estado = '$newValue' ";
		$result = mysqli_query($connectHandler, $query);
		return $result;
	}

	public static function updateConcurso($titulo, $descripcion){
		global $connectHandler;
		$query = "UPDATE concurso SET titulo = '$titulo', descripcion = '$descripcion' ";
		$result = mysqli_query($connectHandler, $query);
		return $result;
	}

}