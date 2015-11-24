<?php

include_once "../model/establecimiento.php";

if (!isset($_SESSION)) session_start();
if (get_class($_SESSION["user"]) != "Establecimiento") {
    header("Location: ../view/403.php");
    exit;
}

if ($_POST["enviarpropuesta_propuesta_nombre"] && $_POST["enviarpropuesta_propuesta_descripcion"] && $_POST["enviarpropuesta_propuesta_ingredientes"] && $_POST["enviarpropuesta_propuesta_precio"] && $_FILES["enviarpropuesta_propuesta_rutaimagen"]) {

    /* Validar imagen */
    $validUpload = 0;
    $validFormats = array("jpg", "jpeg", "png", "bmp");
    $rutaavatar = "images/pinchos/default.jpg";

    $from = $_FILES["enviarpropuesta_propuesta_rutaimagen"];
    $imageFileType = pathinfo($from["name"], PATHINFO_EXTENSION);
    if (is_uploaded_file($from["tmp_name"])) {
        if (in_array($imageFileType, $validFormats)) {
            $rutaimagen = "images/pinchos/" . $_POST["enviarpropuesta_propuesta_nombre"] . "." . $imageFileType;
            $validUpload = 1;
        }
    }

    $resultado = $_SESSION["user"]->enviar_propuesta($_POST["enviarpropuesta_propuesta_nombre"], $_POST["enviarpropuesta_propuesta_descripcion"], $_POST["enviarpropuesta_propuesta_ingredientes"], $_POST["enviarpropuesta_propuesta_precio"], $rutaimagen);
    if ($resultado) {
        move_uploaded_file($from["tmp_name"], "../" . $rutaimagen);
        echo "guardado satisfactorio <br/>";
    } else {
        echo "error en guardado <br/>";
    }
    echo "<a href='../view/list.php'>Volver a pagina principal</a><br/>";
    header("Location: ../view/list.php");

} else {
    //Sketchy, should be handled by javascript, user is not supposed to be here
    header("Location: ../view/404.php");
    exit();//echo "you should not end here. Check javascript form verification";
}

?>