<?php

include_once "../model/juradopopular.php";
include_once "../model/establecimiento.php";

if(!isset($_SESSION)) session_start();
if (empty($_GET["type"])) {
    header("Location: ../view/404.php");
    exit;
}

if (!empty($_SESSION["user"])) {
    header("Location: ../view/list.php");
}

if ($_POST["idemail"] && $_POST["contrasena"] && $_POST["nombre"]) {
    $registerType = $_GET["type"];
    $idemail = $_POST["idemail"];
    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];
    $contrasena_verif = $_POST["contrasena_verif"];
    $baneado = "0";

    /* Jurado profesional */
    if ($registerType == "juradoprofesional") {
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
    } else {
        /* Validar avatar */
        $validUpload = 0;
        $validUploadEst = 0;
        $validFormats = array("jpg", "jpeg", "png", "bmp");
        $rutaavatar = "images/avatars/default.jpg";

        $from = $_FILES["rutaavatar"];
        $imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
        if (is_uploaded_file($from["tmp_name"])) {
            if (in_array($imageFileType, $validFormats)) {
                $rutaavatar = "images/avatars/" . $idemail . "." . $imageFileType;
                $validUpload = 1;
            }
        }

        /* Jurado popular */
        if ($registerType == "juradopopular") {
            if ($contrasena == $contrasena_verif) {
                $userToAdd = new JuradoPopular($idemail, $nombre, $contrasena, $rutaavatar, $baneado);
            } else {
                // Password incorrect. Javascript correct?
            }
        } else {
            /* Establecimiento */
            if ($registerType == "establishment") {
                /* Validar foto establecimiento */
                $rutafoto = "";
                $from = $_FILES["foto"];
                $imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
                if (is_uploaded_file($from["tmp_name"])) {
                    if (in_array($imageFileType, $validFormats)) {
                        $rutafoto = "images/establishments/" . $idemail . "." . $imageFileType;
                        $validUploadEst = 1;
                    }
                }

                $direccion = $_POST["direccion"];
                $paginaweb = $_POST["paginaweb"];
                $horario = $_POST["horario"];
                $coordenadas = $_POST["coordenadas"];

                if ($contrasena == $contrasena_verif) {
                    $userToAdd = new Establecimiento($idemail, $nombre, $contrasena, $rutaavatar, $direccion, $paginaweb, $horario, $rutafoto, $coordenadas, $baneado);
                } else {
                    // Password incorrect. Javascript correct?
                }
            } else {
                //error, you should not end here
                header("Location: ../view/403.php");
                exit;
            }
        }

        /* Registrar y subir avatar si procede */
        $isRegister = $userToAdd->registerUser();
        if ($isRegister && $validUpload) {
            $from = $_FILES["rutaavatar"]["tmp_name"];
            move_uploaded_file($from, "../" . $rutaavatar);
        }
        if($isRegister && $validUploadEst){
            $from = $_FILES["foto"]["tmp_name"];
            move_uploaded_file($from, "../" . $rutafoto);
        }
    }
} else {
    //Javascript: email, pass and name are required
}
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

if ($_SESSION) {
    //if you're login
} else {
    $relpath = '../view/list.php';
    header("Location: http://$host$uri/$relpath");
}


?>