<?php
include_once "../controller/pincho_controller.php";
include_once "../controller/general_user_controller.php";
include_once "../model/juradopopular.php";
include_once "../model/juradoprofesional.php";
include_once "../model/establecimiento.php";
include_once "../model/administrador.php";

if(get_class($_SESSION["user"])!="Administrador"){
    header("Location: 403.php");
    exit;
}
$allUsers = getAllUsuarios();

?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script src="../resources/bootstrap/js/boostrap.min.js"></script>

</head>
<body>
<h1>Administración de Usuarios</h1>
<table border="1">
    <thead>
    <td>Email</td>
    <td>Nombre</td>
    <td>Tipo de Usuario</td>
    <td>Estado</td>
    <td>Acciones</td>
    </thead>
    <tbody>
    <?php
    if(isset($allUsers)) {
        foreach ($allUsers as $user) {
            echo "<tr>";
            echo "<td>" . $user->getIdemail() . "</td>";
            echo "<td>" . $user->getNombre() . "</td>";
            echo "<td>" . get_class($user) . "</td>";
            if ($user->getBaneado() == '1')
                echo "<td> Baneado </td>";
            else
                echo "<td> Activo </td>";
            echo "<td>";
            if (get_class($user) == "JuradoPopular") {
                echo "<a href='../controller/useradmin_controller.php?action=edit&idemail=" . $user->getIdemail() . "'>Editar</a>";
                if ($user->getBaneado()) {
                    echo ", <a href='../controller/useradmin_controller.php?action=unban&idemail=" . $user->getIdemail() . "'>Desbanear</a>";
                } else {
                    echo ", <a href='../controller/useradmin_controller.php?action=ban&idemail=" . $user->getIdemail() . "'>Banear</a>";
                }
            }

            if (get_class($user) == "JuradoProfesional") {
                echo "<a href='../controller/useradmin_controller.php?action=edit&idemail=" . $user->getIdemail() . "'>Editar</a>";
                if ($user->getBaneado()) {
                    echo ", <a href='../controller/useradmin_controller.php?action=unban&idemail=" . $user->getIdemail() . "'>Desbanear</a>";
                } else {
                    echo ", <a href='../controller/useradmin_controller.php?action=ban&idemail=" . $user->getIdemail() . "'>Banear</a>";
                }
            }

            if (get_class($user) == "Establecimiento") {
                echo "<a href='../controller/useradmin_controller.php?action=edit&idemail=" . $user->getIdemail() . "'>Editar</a>";
                if ($user->getBaneado()) {
                    echo ", <a href='../controller/useradmin_controller.php?action=unban&idemail=" . $user->getIdemail() . "'>Desbanear</a>";
                } else {
                    echo ", <a href='../controller/useradmin_controller.php?action=ban&idemail=" . $user->getIdemail() . "'>Banear</a>";
                }
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>

</table>

</body>
</html>
