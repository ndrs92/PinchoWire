<?php

include_once("../resources/code/bd_manage.php");


class PinchoMapper{

	public static function getPinchoIdFromCode($code){
		$toRet = null;

		global $connectHandler;
		$query = "SELECT pincho_idnombre from codigo WHERE idcodigo = '". $code ."'";
		$result = mysqli_query($connectHandler, $query);
		$row = mysqli_fetch_assoc($result);
		return $row["pincho_idnombre"];

	}

	public static function updateEstado($new, $target){
		global $connectHandler;
		$query = "UPDATE pincho SET estadoPropuesta = '".$new."' WHERE idnombre = '".$target."'";
		mysqli_query($connectHandler,$query);
	}

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

	public static function retrieveAllPropuestas(){
		global $connectHandler;
		$toRet = NULL;
		$result = mysqli_query($connectHandler, "Select * from pincho where estadoPropuesta in (0,1)");
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

	public static function createCodeForPincho($code, $idnombre){
		global $connectHandler;
		$query = "INSERT INTO codigo(pincho_idnombre, idcodigo) values('$idnombre', '$code')";
		mysqli_query($connectHandler, $query);
	}

	public static function retrieveAllCodes($idnombre){
		global $connectHandler;
		$toRet = null;
		$query = "Select * from codigo where pincho_idnombre = '$idnombre'";

		$result = mysqli_query($connectHandler, $query);	
		

		while($row = mysqli_fetch_assoc($result)){
			$toRet[$row["idcodigo"]] = $row;
		}

		return $toRet;

	}


	public static function retrieveRetrievedCodes($idnombre){
		global $connectHandler;
		$toRet = NULL;
		$query = "Select * from canjea";

		$result = mysqli_query($connectHandler, $query);	
		
		$allCodes =  PinchoMapper::retrieveAllCodes($idnombre);

		while($row = mysqli_fetch_assoc($result)){
			$allRetrievedCodes[$row["codigo_idcodigo"]] = $row;
		}
		if(isset($allRetrievedCodes)) {
			foreach ($allRetrievedCodes as $individual) {
				if (array_key_exists($individual["codigo_idcodigo"], $allCodes)) {
					$toRet[$individual["codigo_idcodigo"]] = $individual;
				}
			}
		}


		return $toRet;

	}

	public static function retrieveUnusedCodes($idnombre){
		global $connectHandler;
		$query = "Select * from canjea";

		$result = mysqli_query($connectHandler, $query);	
		
		$allCodes =  PinchoMapper::retrieveAllCodes($idnombre);

		while($row = mysqli_fetch_assoc($result)){
			$allRetrievedCodes[$row["codigo_idcodigo"]] = $row;
		}

		if(isset($allRetrievedCodes)) {
			foreach ($allCodes as $individual) {
				if (!array_key_exists($individual["idcodigo"], $allRetrievedCodes)) {
					$toRet[$individual["idcodigo"]] = $individual;
				}
			}
		}
		else{
			return $allCodes;
		}


		return $toRet;

	}


	public static function addPropuesta($nombre, $descripcion, $ingredientes, $precio, $idemail, $rutaimagen){
		global $connectHandler;
		if (!$connectHandler) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$query = "INSERT INTO pincho (idnombre, descripcion, ingredientes, precio, estadoPropuesta, ganadorPopular, establecimiento_idemail, rutaimagen) VALUES ('$nombre','$descripcion','$ingredientes', $precio, 0, null,'$idemail','$rutaimagen');";
		
		if(mysqli_query($connectHandler, $query)){
			return true;
		}  
		else{
			return false;			
		}

	}

	public static function editPropuesta($nombre, $descripcion, $ingredientes, $precio, $idemail){
		global $connectHandler;
		if (!$connectHandler) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$query = "UPDATE pincho SET idnombre = '$nombre', descripcion = '$descripcion', ingredientes = '$ingredientes', precio = $precio WHERE establecimiento_idemail = '$idemail';";
		if(mysqli_query($connectHandler, $query)){
			return true;
		}  
		else{
			return false;			
		}

	}

	public static function toggleMarcado($pinchoid,$userid){
		global $connectHandler;

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

	public static function getPinchoByIdemail($idemail){
		global $connectHandler;
		$row = null;
		$query="SELECT * FROM pincho WHERE establecimiento_idemail = '$idemail' AND estadoPropuesta = 2"; 
		if($result = mysqli_query($connectHandler, $query)){
			$row=mysqli_fetch_assoc($result);
			return $row;
		}  
		else{
			return $row;     
		}
	}

	public static function isProbado($pinchoid, $userid){
		global $connectHandler;

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

	public static function isRetrieved($codigo){
		global $connectHandler;

		$query = "SELECT * FROM canjea WHERE codigo_idcodigo = '$codigo';";
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

	public static function burnCode($codigo, $idemail){
		global $connectHandler;
		$date = date('Y-m-d H:i:sa');

		$query = "INSERT INTO canjea (codigo_idcodigo, juradopopular_idemail, fecha) values('$codigo', '$idemail', '$date')";

		if(mysqli_query($connectHandler, $query)){
			return true;
		}
		else{
			return false;
		}
	}

}

?>