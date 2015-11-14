<?php

include_once("../resources/code/bd_manage.php");


class PinchoMapper{

	public static function retrieveAllAceptados(){
		global $connectHandler;
		$toRet = NULL;
		$result = mysqli_query($connectHandler, "Select * from pincho where estadoPropuesta = 2");
		while($row = mysqli_fetch_assoc($result)){
			$toRet[$row["idnombre"]] = $row;
		}
		if(isset($toRet)){
			return $toRet;
		}
	}

	public static function find($idnombre){
		global $connectHandler;

		$query = "Select * from pincho where idnombre = '".$idnombre."' LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		return mysqli_fetch_assoc($result);
	}

	public static function retrieveAllComentarios($idnombre){
		global $connectHandler;
		$toRet = NULL;
		$result = mysqli_query($connectHandler, "SELECT * FROM comentario WHERE pincho_idnombre = '".$idnombre."' ");
		while($row = mysqli_fetch_assoc($result)){
			$toRet[$row["idcomentario"]] = $row;
		}
		return $toRet;

	}

	public static function addPropuesta($nombre, $descripcion, $ingredientes, $precio, $idemail){
		global $connectHandler;
		if (!$connectHandler) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$query = "INSERT INTO pincho (idnombre, descripcion, ingredientes, precio, estadoPropuesta, ganadorPopular, establecimiento_idemail) VALUES ('$nombre','$descripcion','$ingredientes', $precio, 0, null,'$idemail');";
		
		if(mysqli_query($connectHandler, $query)){
			return true;
		}  
		else{
			return false;			
		}

	}

	public static function toggleMarcado($pinchoid,$userid){
		global $connectHandler;
		if (!$connectHandler) {
			die("Connection failed: " . mysqli_connect_error());
		}

		if(PinchoMapper::isProbado($pinchoid,$userid)){
			$query = "DELETE FROM probado WHERE pincho_idnombre = '$pinchoid' AND juradopopular_idemail = '$userid';";
		}
		else {
			$query = "INSERT INTO probado (pincho_idnombre, juradopopular_idemail) VALUES ('$pinchoid','$userid');";
		}
		if(mysqli_query($connectHandler, $query)){
			return true;
		}
		else{
			return false;
		}
	}

	public static function isProbado($pinchoid, $userid){
		global $connectHandler;
		if (!$connectHandler) {
		die("Connection failed: " . mysqli_connect_error());
		}

		$query = "SELECT * FROM probado WHERE pincho_idnombre = '$pinchoid' AND juradopopular_idemail = '$userid';";
		$result = mysqli_query($connectHandler, $query);
		$exist = mysqli_num_rows($result);
		if(mysqli_query($connectHandler, $query)){
			if($exist == 1) {
				return true;
			}
			else {
				return false;
			}
		}
		else{
			return false;
		}
	}

}

?>