<?php

include_once "../model/juradopopular.php";
include_once "../model/establecimiento.php";

session_start();
if (empty($_GET["type"])) {
    header("Location: ../view/404.php");
    exit;
}

if (!empty($_SESSION["user"])) {
    header("Location: ../view/list.php");
}

$registerType = $_GET["type"];

if ($registerType == "juradopopular") {
    $idemail = $_POST["idemail"];
    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];
    $contrasena_verif = $_POST["contrasena_verif"];
    $baneado = "0";

    $validAvatar = 0;
    if (is_uploaded_file($_FILES["rutaavatar"]["tmp_name"])) {
        $from = $_FILES["rutaavatar"]["tmp_name"];
        $rutaavatar = "images/avatars/" . $idemail;
        $validAvatar = 1;
    } else {
        $rutaavatar = "images/avatars/defect";
    }

    if ($contrasena == $contrasena_verif) {
        $userToAdd = new JuradoPopular($idemail, $nombre, $contrasena, $rutaavatar, $baneado);
        if ($userToAdd->registerUser() && $validAvatar) {
            move_uploaded_file($from, "../" . $rutaavatar);
        }
    } else {
        // Password incorrect. Javascript correct?
    }

    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    if ($_SESSION) {
        //if you're login
    } else {
        $relpath = '../view/list.php';
        header("Location: http://$host$uri/$relpath");
    }
} else {
    if ($registerType == "establishment") {
        $idemail = $_POST["idemail"];
        $nombre = $_POST["nombre"];
        $contrasena = $_POST["contrasena"];
        $contrasena_verif = $_POST["contrasena_verif"];
        $direccion = $_POST["direccion"];
        $paginaweb = $_POST["paginaweb"];
        $horario = $_POST["horario"];
        $coordenadas = $_POST["coordenadas"];
        $foto = $_POST["foto"];
        $baneado = "0";

        $validAvatar = 0;
        if (is_uploaded_file($_FILES["rutaavatar"])) {
            $from = $_FILES["rutaavatar"]["tmp_name"];
            $rutaavatar = "images/avatars/" . $idemail;
            $validAvatar = 1;
        } else {
            $rutaavatar = "images/avatars/defect";
        }

        if ($contrasena == $contrasena_verif) {
            $userToAdd = new Establecimiento($idemail, $nombre, $contrasena, $rutaavatar, $direccion, $paginaweb, $horario, $foto, $coordenadas, $baneado);
            if ($userToAdd->registerUser() && $validAvatar) {
                move_uploaded_file($from, "../" . $rutaavatar);
            }
        } else {
            // Password incorrect. Javascript correct?
        }

        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        if ($_SESSION) {
            //if you're login
        } else {
            $relpath = '../view/list.php';
            header("Location: http://$host$uri/$relpath");
        }
    } else {
        if ($registerType == "juradoprofesional") {
            $idemail = $_POST["idemail"];
            $nombre = $_POST["nombre"];
            $contrasena = $_POST["contrasena"];
            $contrasena_verif = $_POST["contrasena_verif"];
            $baneado = "0";

            if ($contrasena == $contrasena_verif) {
                $userToAdd = new JuradoProfesional($idemail, $nombre, $contrasena, "", "", $baneado);
                $userToAdd->registerUser();
            } else {
                // Password incorrect. Javascript correct?
            }

            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

            if ($_SESSION) {
                //if you're login
            } else {
                $relpath = '../view/view_admin_usuarios.php';
                header("Location: http://$host$uri/$relpath");
            }
        }

        //error, you should not end here
        header("Location: ../view/403.php");
        exit;

    }
}


?>