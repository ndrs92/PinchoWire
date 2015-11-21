<?php
include_once "../model/pincho.php";
 
//Returns arrays of pinchos to list in the view
function getAllPinchos(){
	return Pincho::getAllPinchos();
}

function getCurrentPincho($idNombre){
	return Pincho::getByIdnombre($idNombre);
}

function getAllComentarios($pinchoActual){
	return $pinchoActual->getAllComentarios();
}

function isProbado($pinchoid,$userid){
	return PinchoMapper::isProbado($pinchoid,$userid);
}

function getCurrentEstablishment($pincho){
	return $pincho->getEstablishment();
}

?>