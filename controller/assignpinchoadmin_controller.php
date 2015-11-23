 <?php
 include_once("../model/usuario.php");
 include_once("../model/administrador.php");

if(!isset($_SESSION)) session_start();
if(get_class($_SESSION["user"])!="Administrador"){
    header("Location: ../view/403.php");
    exit;
}

 if($_POST["pincho"] && $_POST["asignar"]){
 	$result = Usuario::assignPinchoJuradoProfesional( $_POST["asignar"], $_POST["pincho"]);
 	if($result){
 		header("Location: ../view/view_admin_asignar.php");
 	}
 	else{
 		echo "Error al asignar el pincho";
 	}
 }
 else{
 	header("Location: ../view/404.php");
    exit();
 }
 ?>