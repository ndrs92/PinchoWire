<?php
session_start();
include_once "../model/usuario.php";


function verPerfil()
{
    if (!isset($_SESSION["user"])) {
        throw new Exception("Debes iniciar sesion");
    }

    $user = UserMapper::findByEmail($_SESSION["user"], $_SESSION["usertype"]);

    if ($user == NULL) {
        throw new Exception("No existe usuario. Tipico si cambiaste el email...");
    }

    return $user;
}

if (isset($_POST["profile_user_submit"])) {

    if ($_POST["profile_mail"] && $_POST["profile_pass"] && $_POST["profile_name"]) {

        switch ($_SESSION["usertype"]) {

            case "administrador":
                userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $_POST["profile_avatar"], "administrador", NULL, NULL, NULL, NULL, NULL, NULL);
                break;

            case "juradoprofesional":
                userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $_POST["profile_avatar"], "juradoprofesional", $_POST["profile_curriculum"], NULL, NULL, NULL, NULL);
                break;

            case "juradopopular":
                userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $_POST["profile_avatar"], "juradopopular", NULL, NULL, NULL, NULL, NULL, NULL);
                break;

            case "establecimiento":
                userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $_POST["profile_avatar"], "establecimiento", NULL, $_POST["profile_direccion"], $_POST["profile_web"], $_POST["profile_horario"], $_POST["profile_rutaimagen"], $_POST["profile_geoloc"]);
                break;
        }

        echo "Datos guardados";
        header("Location: ../view/profile.php");
    } else {
        throw new Exception("Ningun campo puede estar vacio. Comprobar javascript");
    }


}

?>