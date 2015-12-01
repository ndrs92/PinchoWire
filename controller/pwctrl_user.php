<?php

class UserController{

	//Logs user into application
	public static function login(){
		global $l;
		if(!isset($_SESSION)) session_start();

		if(!empty($_SESSION["user"])){
			header("Location: ../view/list.php");
		}
		//If all data was passed as required
		if($_POST["login_user_login"] && $_POST["login_user_pass"]){
			$userObject = Usuario::login_user($_POST["login_user_login"], md5($_POST["login_user_pass"]));

			//If user does not exist in database
			if($userObject == NULL){
				$_SESSION["alert"]["error"] = $l["alertify_login_fail"];
				$host  = $_SERVER['HTTP_HOST'];
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$relpath = '../view/login.php';
				header("Location: http://$host$uri/$relpath");

			//If user is banned
			}else if($userObject->getBaneado()){
				$_SESSION["alert"]["error"] = $l["alertify_login_banned"];
				$host  = $_SERVER['HTTP_HOST'];
				$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$relpath = '../view/login.php';
				header("Location: http://$host$uri/$relpath");
			}
			else {
			//Login correct
				$_SESSION["user"] = $userObject;
				header("Location: ../view/list.php");
			}
		}else{
			//Sketchy, should be handled by javascript, user is not supposed to be here
			header("Location: ../view/404.php");
			exit();
		}
	}

	//Logs out user from application
	public static function logout(){
		global $l;
		if(!isset($_SESSION)) session_start();
		session_destroy();
		header("Location: ../view/list.php");
	}

	public static function addComment(){
		global $l;
		if(!isset($_SESSION)) session_start();
		if(get_class($_SESSION["user"])!="JuradoPopular"){
			header("Location: ../view/403.php");
			exit;
		}
		if($_POST["addcomment_comment_name"] && $_POST["addcomment_comment_idpincho"]){
			$_SESSION["user"]->comentar_pincho($_POST["addcomment_comment_idpincho"],$_POST["addcomment_comment_name"]);
			header("Location: ../view/viewPincho.php?id=".$_POST["addcomment_comment_idpincho"]);
		}else{
			header("Location: ../view/404.php");
			exit();
		}
	}

	public static function deleteComment(){
		global $l;
		if (!isset($_SESSION)) session_start();
		if (get_class($_SESSION["user"]) != "JuradoPopular" && get_class($_SESSION["user"]) != "Administrador") {
			header("Location: ../view/403.php");
			exit;
		}
		if ($_POST["delcomment_comment_id"] && $_POST["delcomment_comment_idpincho"]) {
			$_SESSION["user"]->eliminar_comentario($_POST["delcomment_comment_id"]);
			header("Location: ../view/viewPincho.php?id=" . $_POST["delcomment_comment_idpincho"]);
		} else {
			header("Location: ../view/404.php");
			exit();
		}
	}

	public static function setLanguage(){
		global $l;
		if(isset($_GET["l"])){
			setcookie("user_lang", $_GET["l"], time()+3600*24, "/");
		}
		echo '<script type="text/javascript">history.go(-1);</script>';
	}

	public static function getAllUsuarios(){
		return Usuario::getAllUsuarios();
	}

	public static function getAllEstablecimientos(){
		return Establecimiento::getAll();
	}

	public static function getUsuarioById($idemail){
		return Usuario::getByIdemail($idemail);
	}

	public static function pinchoConsumed(){
		global $l;
		if(!isset($_SESSION)) session_start();
		if(get_class($_SESSION["user"])!="JuradoPopular"){
			header("Location: ../view/403.php");
			exit;
		}
		if($_POST["markeatenpincho_probado_idpincho"] && $_POST["markeatenpincho_probado_idemail"]){
			PinchoMapper::toggleMarcado($_POST["markeatenpincho_probado_idpincho"],$_POST["markeatenpincho_probado_idemail"]);
			if(PinchoMapper::isProbado($_POST["markeatenpincho_probado_idpincho"],$_POST["markeatenpincho_probado_idemail"])){
				$_SESSION["alert"]["success"] = $l["alertify_eatenPincho_eaten"];
			} else {
				$_SESSION["alert"]["success"] = $l["alertify_eatenPincho_noEaten"];
			}
			header("Location: ../view/list.php");
		}else{
			header("Location: ../view/404.php");
			exit();
		}
	}

	function isEstablishment($idemail){
		$result = UserMapper::findByEmail($idemail, "establecimiento");
		if($result == NULL)
			return false;
		return true;
	}

	function verPerfil($idemail){
		$user = Usuario::getByIdemail($idemail);
		if ($user == NULL) {
			header("Location: ../view/login.php");
			exit();
		}
		return $user;
	}

	function changeProfile(){
		if(!isset($_SESSION)) session_start();
		global $l;
		if (isset($_POST["profile_user_submit"])) {
			if ($_POST["profile_mail"] && $_POST["profile_pass"] && $_POST["profile_name"]) {
				/* Validar avatar */
				$rutaavatar = $_POST["avatar"];
				$validFormats = array("jpg", "jpeg", "png", "bmp");
				if (is_uploaded_file($_FILES["profile_avatar"]["tmp_name"])) {
					$from = $_FILES["profile_avatar"];
					$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
					if (in_array($imageFileType, $validFormats)) {
						$rutaavatar = "images/avatars/" . $_POST["profile_mail"] . "." . $imageFileType;
						move_uploaded_file($from["tmp_name"], "../" . $rutaavatar);
					}
				}
				/* Validar fotografia local */
				$rutaimagen = $_POST["imagen"];
				if (is_uploaded_file($_FILES["profile_foto"]["tmp_name"])) {
					$from = $_FILES["profile_foto"];
					$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
					if (in_array($imageFileType, $validFormats)) {
						$rutaimagen = "images/establishments/" . $_POST["profile_mail"] . "." . $imageFileType;
						move_uploaded_file($from["tmp_name"], "../" . $rutaimagen);
					}
				}
				switch ($_POST["type"]) {
					case "administrador":
					userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $rutaavatar, "administrador", NULL, NULL, NULL, NULL, NULL, NULL);
					break;

					case "juradoprofesional":
					userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $rutaavatar, "juradoprofesional", $_POST["profile_curriculum"], NULL, NULL, NULL, NULL);
					break;

					case "juradopopular":
					userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $rutaavatar, "juradopopular", NULL, NULL, NULL, NULL, NULL, NULL);
					break;

					case "establecimiento":
					userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $rutaavatar, "establecimiento", NULL, $_POST["profile_direccion"], $_POST["profile_web"], $_POST["profile_horario"], $rutaimagen, $_POST["profile_geoloc"]);
					break;
				}
				header("Location: ../view/profile.php?idemail=".$_POST['profile_mail']);
			} else {
				throw new Exception("Ningun campo puede estar vacio. Comprobar javascript");
			}


		}
	}

	public static function register(){
		global $l;
		if(!isset($_SESSION)) session_start();
		if (empty($_GET["type"])) {
			header("Location: ../view/404.php");
			exit;
		}

		if (!empty($_SESSION["user"])) {
			header("Location: ../view/list.php");
		}

		if ($_POST["idemail"] && $_POST["contrasena"] && $_POST["nombre"]) {
			$registerType = $_GET["type"];
			$idemail = $_POST["idemail"];
			$nombre = $_POST["nombre"];
			$contrasena = $_POST["contrasena"];
			$contrasena_verif = $_POST["contrasena_verif"];
			$baneado = "0";

			/* Jurado profesional */
			if ($registerType == "juradoprofesional") {
				if ($contrasena == $contrasena_verif) {
					$userToAdd = new JuradoProfesional($idemail, $nombre, $contrasena, "", "", $baneado);
					$userToAdd->registerUser();
				} else {
            // Password incorrect. Javascript correct?
				}

				$host = $_SERVER['HTTP_HOST'];
				$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

				if ($_SESSION) {
            //if you're login
				} else {
					$relpath = '../view/view_admin_usuarios.php';
					header("Location: http://$host$uri/$relpath");
				}
			} else {
				/* Validar avatar */
				$validUpload = 0;
				$validUploadEst = 0;
				$validFormats = array("jpg", "jpeg", "png", "bmp");
				$rutaavatar = "images/avatars/default.jpg";

				$from = $_FILES["rutaavatar"];
				$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
				if (is_uploaded_file($from["tmp_name"])) {
					if (in_array($imageFileType, $validFormats)) {
						$rutaavatar = "images/avatars/" . $idemail . "." . $imageFileType;
						$validUpload = 1;
					}
				}

				/* Jurado popular */
				if ($registerType == "juradopopular") {
					if ($contrasena == $contrasena_verif) {
						$userToAdd = new JuradoPopular($idemail, $nombre, $contrasena, $rutaavatar, $baneado);
					} else {
                // Password incorrect. Javascript correct?
					}
				} else {
					/* Establecimiento */
					if ($registerType == "establishment") {
						/* Validar foto establecimiento */
						$rutafoto = "";
						$from = $_FILES["foto"];
						$imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
						if (is_uploaded_file($from["tmp_name"])) {
							if (in_array($imageFileType, $validFormats)) {
								$rutafoto = "images/establishments/" . $idemail . "." . $imageFileType;
								$validUploadEst = 1;
							}
						}

						$direccion = $_POST["direccion"];
						$paginaweb = $_POST["paginaweb"];
						$horario = $_POST["horario"];
						$coordenadas = $_POST["coordenadas"];

						if ($contrasena == $contrasena_verif) {
							$userToAdd = new Establecimiento($idemail, $nombre, $contrasena, $rutaavatar, $direccion, $paginaweb, $horario, $rutafoto, $coordenadas, $baneado);
						} else {
                    // Password incorrect. Javascript correct?
						}
					} else {
                //error, you should not end here
						header("Location: ../view/403.php");
						exit;
					}
				}

				/* Registrar y subir avatar si procede */
				$isRegister = $userToAdd->registerUser();
				if ($isRegister && $validUpload) {
					$from = $_FILES["rutaavatar"]["tmp_name"];
					move_uploaded_file($from, "../" . $rutaavatar);
				}
				if($isRegister && $validUploadEst){
					$from = $_FILES["foto"]["tmp_name"];
					move_uploaded_file($from, "../" . $rutafoto);
				}
			}
		} else {
    //Javascript: email, pass and name are required
		}
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

		if ($_SESSION) {
    //if you're login
		} else {
			$relpath = '../view/list.php';
			header("Location: http://$host$uri/$relpath");
		}
	}


	public static function votacionPopular(){
		global $l;
		if(!isset($_SESSION)) session_start();

		if(get_class($_SESSION["user"]) != "JuradoPopular"){
			header("Location: ../view/403.php");
			exit;
		}

		if($_POST["votacionpopular_codigo1"] && $_POST["votacionpopular_codigo2"] && $_POST["votacionpopular_codigo3"] && $_POST["votacionpopular_idpincho"]){
			$pinchoCodigo1 = PinchoMapper::getPinchoIdFromCode($_POST["votacionpopular_codigo1"]);
			$pinchoCodigo2 = PinchoMapper::getPinchoIdFromCode($_POST["votacionpopular_codigo2"]);
			$pinchoCodigo3 = PinchoMapper::getPinchoIdFromCode($_POST["votacionpopular_codigo3"]);
			$relpath = '../view/view_votacionpopular.php?idpincho='. $_POST["votacionpopular_idpincho"];

			if( $pinchoCodigo1 == $_POST["votacionpopular_idpincho"] ||
				$pinchoCodigo2 == $_POST["votacionpopular_idpincho"] ||
				$pinchoCodigo3 == $_POST["votacionpopular_idpincho"]) {
       		 	//Uno de los pinchos es el pincho por el cual se quiere votar
				if(isset($pinchoCodigo1,$pinchoCodigo2,$pinchoCodigo3)) {
            		//Todos los códigos existen en la BD
					if (($pinchoCodigo1 != $pinchoCodigo2) && ($pinchoCodigo1 != $pinchoCodigo3) && ($pinchoCodigo2 != $pinchoCodigo3)) {
                		//Todos los codigos son de pinchos diferentes
						if((!PinchoMapper::isRetrieved($_POST["votacionpopular_codigo1"])) &&
							(!PinchoMapper::isRetrieved($_POST["votacionpopular_codigo2"])) &&
							(!PinchoMapper::isRetrieved($_POST["votacionpopular_codigo3"]))){
                    		//Ninguno de los pinchos ha sido usado ya
							global $connectHandler;
						try {

							$connectHandler->autocommit(false);
							$_SESSION["user"]->votar_pincho($_POST["votacionpopular_idpincho"]);
							PinchoMapper::burnCode($_POST["votacionpopular_codigo1"], $_SESSION["user"]->getIdemail());
							PinchoMapper::burnCode($_POST["votacionpopular_codigo2"], $_SESSION["user"]->getIdemail());
							PinchoMapper::burnCode($_POST["votacionpopular_codigo3"], $_SESSION["user"]->getIdemail());

							if( !PinchoMapper::isProbado($pinchoCodigo1, $_SESSION["user"]->getIdemail()) ){
								PinchoMapper::toggleMarcado($pinchoCodigo1, $_SESSION["user"]->getIdemail());
							}
							if( !PinchoMapper::isProbado($pinchoCodigo2, $_SESSION["user"]->getIdemail()) ){
								PinchoMapper::toggleMarcado($pinchoCodigo2, $_SESSION["user"]->getIdemail());
							}
							if( !PinchoMapper::isProbado($pinchoCodigo3, $_SESSION["user"]->getIdemail()) ){
								PinchoMapper::toggleMarcado($pinchoCodigo3, $_SESSION["user"]->getIdemail());
							}
							$connectHandler->commit();

							$relpath = '../view/list.php';
							$_SESSION["alert"]["success"] = $l["alertify_votacionPopular_error"];
						}
						catch (Exception $e){
							$connectHandler->rollback();
						}
						$connectHandler->autocommit(true);
					}
					else {
						$_SESSION["alert"]["error"] = $l["alertify_votacionPopular_error_codeBurnt"];
					}
				}
				else {
					$_SESSION["alert"]["error"] = $l["alertify_votacionPopular_error_codeMultiplePinchoCode"];
				}
			}
			else {
				$_SESSION["alert"]["error"] = $l["alertify_votacionPopular_error_invalidCode"];
			}
		}
		else{
			$_SESSION["alert"]["error"] = $l["alertify_votacionPopular_error_noPinchoCode"];
		}
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: http://$host$uri/$relpath");
	}else{
		header("Location: ../view/404.php");
		exit();
	}
}


public static function votacionProfesionalFinalista(){
	if (!isset($_SESSION)) session_start();
	if (get_class($_SESSION["user"]) != "JuradoProfesional") {
		header("Location: ../view/403.php");
		exit;
	}

	if ($_POST["pincho"] && $_POST["puntuacion"]){
		$return = $_SESSION["user"]->votacionPromociona($_POST["pincho"], $_POST["puntuacion"] );
		if($return){
			header("Location: ../view/view_votacionprofesional.php");
		}
		else{
			echo "Error BD votacionprofesionalparafinalista_controller.php";
		}
	}

}

public static function votacionProfesionalParaGanador(){
	if (!isset($_SESSION)) session_start();
	$concurso = new Concurso();
	if (get_class($_SESSION["user"]) != "JuradoProfesional" || $concurso->getEstado() != 1 ) {
		header("Location: ../view/403.php");
		exit;
	}

	if ($_POST["pincho"] && $_POST["puntuacion"]){
		$return = $_SESSION["user"]->votacionFinalista($_POST["pincho"], $_POST["puntuacion"] );
		if($return){
			header("Location: ../view/view_votacionprofesionalfinal.php");
		}
		else{
			echo "Error BD votacionprofesionalparaganador_controller.php";
		}
	}
}

}

?>