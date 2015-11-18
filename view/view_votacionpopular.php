<?php
include_once "../resources/code/lang_coverage.php";

session_start();
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $l["view_votacionpopular_tittle"]?></title>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css" />
    <link rel="stylesheet" type="text/css" href="../css/main.css" />
    <script src="../resources/bootstrap/js/boostrap.min.js" ></script>

</head>
<body>
<h1><?= $l["view_votacionpopular_titulo"] . $_GET["idpincho"]?> </h1>
<h2><?= $l["view_votacionpopular_subtitulo"] ?></h2>
<form action="../controller/votacionpopular_controller.php" method="POST">
    <?= $l["view_votacionpopular_codigo1"] . $_GET["idpincho"] ?><input type="text" name="votacionpopular_codigo1" placeholder="<?= $l["view_votacionpopular_codigo1_placeholder"]?>"/>
    <br/>
    <?= $l["view_votacionpopular_codigo2"] ?><input type="text" name="votacionpopular_codigo2" placeholder="<?= $l["view_votacionpopular_codigo2_placeholder"] ?>"/>
    <br/>
    <?= $l["view_votacionpopular_codigo3"] ?><input type="text" name="votacionpopular_codigo3" placeholder="<?= $l["view_votacionpopular_codigo3_placeholder"] ?>"/>
    <br/>
    <?= "<input type=\"hidden\" name=\"votacionpopular_idpincho\" value=\"" . $_GET["idpincho"] ."\">"; ?>
    <input type="submit" name="enviarpropuesta_propuesta_enviar" value="<?= $l["view_votacionpopular_enviar"] ?>" />
</form>
</body>
</html>
