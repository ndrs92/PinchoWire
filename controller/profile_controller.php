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

        if (is_uploaded_file($_FILES["profile_avatar"]["tmp_name"])) {
            $from = $_FILES["profile_avatar"]["tmp_name"];
            $rutaavatar = "images/avatars/" . $_POST["profile_mail"];
        } else {
            $rutaavatar = $_POST["avatar"];
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
                userMapper::update($_POST["profile_mail"], $_POST["profile_pass"], $_POST["profile_name"], $rutaavatar, "establecimiento", NULL, $_POST["profile_direccion"], $_POST["profile_web"], $_POST["profile_horario"], $_POST["profile_rutaimagen"], $_POST["profile_geoloc"]);
                break;
        }

        if (is_uploaded_file($_FILES["profile_avatar"]["tmp_name"])) {
            move_uploaded_file($from, "../" . $rutaavatar);
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