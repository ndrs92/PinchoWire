<?php
include_once "../model/usuario.php";
if(!isset($_SESSION)) session_start();

function isEstablishment($idemail){
    $result = UserMapper::findByEmail($idemail, "establecimiento");
    if($result == NULL)
        return false;
    return true;
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


        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $relpath = '../view/profile.php?idemail='.$_POST["profile_mail"];
        header("Location: http://$host$uri/$relpath");
    } else {
        throw new Exception("Ningun campo puede estar vacio. Comprobar javascript");
    }


}

?>