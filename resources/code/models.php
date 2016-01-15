<?php

/*
	Includes all application models.
	Relative route specifies only ../ as it is only meant to be used in:
		- Views
		- Controllers
		- Models
*/

include_once __DIR__."/../../model/administrador.php";
include_once __DIR__."/../../model/concurso.php";
include_once __DIR__."/../../model/establecimiento.php";
include_once __DIR__."/../../model/juradopopular.php";
include_once __DIR__."/../../model/juradoprofesional.php";
include_once __DIR__."/../../model/pincho.php";
include_once __DIR__."/../../model/usuario.php";

?>