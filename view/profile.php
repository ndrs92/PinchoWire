<?php

//Super duper helper codes
include_once "../resources/code/lang_coverage.php";


/** CODIGO DE PRUEBAS */
include "../model/usuario.php";
include "../model/userMapper.php";

$admin = UserMapper::findByEmailAdmin("admin@admin.es");
$admin->getDatos();



/** FIN CODIGO DE PRUEBAS */
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title> <?= $p["view_profile_edit"] ?> </title>
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<script src="../resources/bootstrap/js/boostrap.min.js" ></script>
</head>
<body>
	<h1><?= $p["view_profile_title"] ?> </h1>
	<form action="../controller/profile_controller" method="POST">
		<?= $p["view_profile_editmail"] ?><input type="text" name="profile_mail" placeholder="<?= "mail" ?>" />
		<br/>
		<?= $p["view_profile_editpass"] ?><input type="text" name="profile_pass" placeholder="<?= "password" ?>" />
		<br/>
		<?= $p["view_profile_editname"] ?><input type="text" name="profile_name" placeholder="<?= "pass" ?>" />
		<br/>
		<?= $p["view_profile_editavatar"] ?><input type="text" name="profile_avatar" placeholder="<?= "avatar" ?>" />
		<br/>
		<input type="submit" name="profile_user_submit" value="<?= $p["view_profile_save"] ?>" />
	</form>
</body>
</html>