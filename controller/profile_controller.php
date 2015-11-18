<?php
include_once "../model/usuario.php";
session_start();

if(empty($_SESSION["user"])){
    header("Location: ../view/403.php");
}

function verPerfil($idemail){
    $user = Usuario::getByIdemail($idemail);

    if ($user == NULL) {
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $relpath = '../view/login.php';
        header("Location: http://$host$uri/$relpath");
    }

    return $user;
}

if (isset($_POST["profile_user_submit"])) {

    if ($_POST["profile_mail"] && $_POST["profile_pass"] && $_POST["profile_name"]) {

        switch ($_POST["type"]) {

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

        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $relpath = '../view/profile.php';
        header("Location: http://$host$uri/$relpath");
    } else {
        throw new Exception("Ningun campo puede estar vacio. Comprobar javascript");
    }


}

?>