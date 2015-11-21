<?php

//fun little code that redirects clients from a relative path correctly.
//Just populate $relpath with your desired path and let the magic go.

include_once("resources/code/bd_manage.php");
if($connectHandler){
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	$relpath = 'view/list.php'; 

	header("Location: http://$host$uri/$relpath");
	
}
else{
	?>
	<h1>No se ha encontrado la Base de Datos</h1>
	<br>
	<h3>Para crear la base de datos introduzca:</h3>
	<form action = "controller/createDB_controller.php" method = "post">
		Host: <input type = "text" name = "host"></br>
		Nombre Usuario: <input type = "text" name = "user"></br>
		Contraseña: <input type = "password" name = "pass"></br>
		<input type= "submit" name = "submit" value = "Enviar">
	</form>
	<?php
}


?>