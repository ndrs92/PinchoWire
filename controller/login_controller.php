<?php
session_start();

include_once "../model/usuario.php";


if(!empty($_SESSION["user"])){
	header("Location: ../view/list.php");
}

if($_POST["login_user_login"] && $_POST["login_user_pass"]){
	//Okey, all seems legit, proceed to log in

	$userObject = Usuario::login_user($_POST["login_user_login"], $_POST["login_user_pass"]);

	session_start();
	if($userObject == NULL){

		$_SESSION["login"] = "fail";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$relpath = '../view/login.php';
		header("Location: http://$host$uri/$relpath");

	}
	else {
		//Opens a session if not open; we save the user object in it to have all the required functionalities

		$_SESSION["user"] = $userObject;

		echo "<br>Redireccion a la pagina principal...";

		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$relpath = '../view/list.php';
		header("Location: http://$host$uri/$relpath");
	}

	//echo "Error: Login yet to be implemented. Sorry";

}else{
	//Sketchy, should be handled by javascript, user is not supposed to be here
	echo "you should not end here. Check javascript form verification";
}

?>