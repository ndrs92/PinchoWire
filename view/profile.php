<?php
//Super duper helper codes
include_once "../resources/code/lang_coverage.php";
include_once "../controller/profile_controller.php";
$user = verPerfil();
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
    <form action="../controller/profile_controller.php" method="POST">
        <?php echo $p["view_profile_editmail"] ?><input type="text" name="profile_mail" value="<? echo $user->getIdmail(); ?>" /><br/>
        <?php echo $p["view_profile_editpass"] ?><input type="text" name="profile_pass" value="<? echo $user->getContrasena(); ?>" /><br/>
        <?php echo $p["view_profile_editname"] ?><input type="text" name="profile_name" value="<? echo $user->getNombre(); ?>" /><br/>
        <?php echo $p["view_profile_editavatar"] ?><input type="text" name="profile_avatar" value="<? echo $user->getRutaavatar(); ?>" /><br/>

        <?php if($_SESSION["usertype"]=="juradoprofesional"){
            echo $p["view_profile_editcurriculum"] ?><textarea rows="4" cols="50" name="profile_curriculum"><? echo $user->getCurriculum(); ?></textarea><br/>
            <?php } ?>

            <?php if($_SESSION["usertype"]=="establecimiento"){
              echo $p["view_profile_address"] ?><input type="text" name="profile_direccion" value="<? echo $user->getDireccion(); ?>" /><br/>
              <?php echo $p["view_profile_web"] ?><input type="text" name="profile_web" value="<? echo $user->getWeb(); ?>" /><br/>
              <?php echo $p["view_profile_schedule"] ?><input type="text" name="profile_horario" value="<? echo $user->getHorario(); ?>" /><br/>
              <?php echo $p["view_profile_image"] ?><input type="text" name="profile_rutaimagen" value="<? echo $user->getRutaimagen(); ?>" /><br/>
              <?php echo $p["view_profile_geloc"] ?><input type="text" name="profile_geoloc" value="<? echo $user->getGeoloc(); ?>" /><br/>
              <?php } ?>

              <input type="submit" name="profile_user_submit" value="<?= $p["view_profile_save"] ?>" />
          </form>
      </body>
      </html>