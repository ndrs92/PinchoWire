<?php
include_once("../resources/code/bd_manage.php");

class ConcursoMapper{

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

}