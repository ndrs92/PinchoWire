<?php

//Super duper helper codes
include_once "../resources/code/lang_coverage.php";

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> <?= $l["view_addcomment_tittle"] ?> </title>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script src="../resources/bootstrap/js/boostrap.min.js" ></script>
</head>
<body>
<h1>Pincho: <?= $_GET["idpincho"]?></h1>
<!--To implement, pincho data-->
<h2> Datos del pincho</h2>
<h6>To be implemented :D</h6>
<h2> Comentarios:</h2>
<h6>To be implemented :D</h6>
<h1><?= $l["view_addcomment_tittle"] ?> </h1>
<form action="../controller/addcomment_controller.php" method="POST">
    <?= $l["view_addcomment_comment"] ?><input type="text" name="addcomment_comment_name" placeholder="<?= $l["view_addcomment_comment_placeholder"] ?>" />
    <input type="hidden" name="addcomment_comment_idpincho" value="<?= $_GET["idpincho"]?>"/>
    <input type="submit" name="addcomment_comment_send" value="<?= $l["view_addcomment_send"] ?>" />
</form>
</body>
</html>