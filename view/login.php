<?php
session_start();
//Super duper helper codes
include_once "../resources/code/lang_coverage.php";

if(!empty($_SESSION["user"])){
	header("Location: list.php");
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title> <?= $l["view_login_authenticate"] ?> </title>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script src="../resources/bootstrap/js/boostrap.min.js"></script>
</head>
<body>
<h1><?= $l["view_login_welcome"] ?> </h1>
<?php
if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] == "fail")
        echo "Login incorrecto";
    if ($_SESSION["login"] == "banned")
        echo "Este usuario ha sido baneado. Póngase en contacto con el Administrador";
    session_unset();
}
?>
<form action="../controller/login_controller.php" method="POST">
    <?= $l["view_login_introuser"] ?><input type="text" name="login_user_login"
                                            placeholder="<?= $l["view_login_introuser_placeholder"] ?>"/>
    <br/>
    <?= $l["view_login_intropass"] ?><input type="password" name="login_user_pass"
                                            placeholder="<?= $l["view_login_intropass_placeholder"] ?>"/>
    <br/>
</body>
<input type="submit" name="login_user_submit" value="<?= $l["view_login_login"] ?>"/>
</form>
</html>