<?php
include_once "../resources/code/models.php";

/* Not meant to be executed, only called at */

function search($search_data){
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


?>