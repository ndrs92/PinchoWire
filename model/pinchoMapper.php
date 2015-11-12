<?php

include_once("../resources/code/bd_manage.php");


class PinchoMapper{

	public static function retrieveAll(){
		global $connectHandler;
		$result = mysqli_query($connectHandler, "Select * from pincho");
		while($row = mysqli_fetch_assoc($result)){
			$toRet[$row["idnombre"]] = $row;
		}
		return $toRet;
	}

	public static function find($idnombre){
		global $connectHandler;

		$query = "Select * from pincho where idnombre = '".$idnombre."' LIMIT 1";
		$result = mysqli_query($connectHandler, $query);
		return mysqli_fetch_assoc($result);
	}

	public static function retrieveAllComentarios($idnombre){
		global $connectHandler;
		$result = mysqli_query($connectHandler, "SELECT * FROM comentario WHERE pincho_idnombre = '".$idnombre."' ");
		while($row = mysqli_fetch_assoc($result)){
			$toRet[$row["idcomentario"]] = $row;
		}
		return $toRet;

	}


}

?>