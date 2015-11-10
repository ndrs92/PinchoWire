<?php
session_start();

	include_once "../model/usuario.php";


if($_POST["login_user_login"] && $_POST["login_user_pass"]){
	//Okey, all seems legit, proceed to log in

	Usuario::login_user($_POST["login_user_login"], $_POST["login_user_pass"]);



	echo "<br>Redireccion a la pagina principal...";

	//echo "Error: Login yet to be implemented. Sorry";

}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	echo "you should not end here. Check javascript form verification";
}

?>