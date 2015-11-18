<?php

include_once "../model/pincho.php";

session_start();

$pinchoList = Pincho::getAllPropuestas();

?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Administración de Pinchos</title>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../resources/bootstrap/css/bootstrap-theme.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script src="../resources/bootstrap/js/boostrap.min.js"></script>

</head>
<body>
<h1>Administración de Pinchos</h1>
<table border="1">
    <thead>
    <td>Establecimiento encargado</td>
    <td>Nombre</td>
    <td>Descripcion</td>
    <td>Ingredientes</td>
    <td>Estado</td>
    <td>Acciones</td>
    </thead>
    <tbody>
    <?php
    if (isset($pinchoList)) {
        foreach ($pinchoList as $indexRow => $row) {
            echo "<tr>";
            echo "<td>" . $indexRow . "</td>";
            echo "<td>" . $row->getIdnombre() . "</td>";
            echo "<td>" . $row->getDescripcion() . "</td>";
            echo "<td>" . $row->getIngredientes() . "</td>";

            switch ($row->getEstadopropuesta()) {
                case 0:
                    echo "<td>Pendiente</td>";
                    break;
                case 1:
                    echo "<td>Denegado</td>";
                    break;
                default:
                    echo "<td>Error por aqui</td>";
                    break;
            }

            switch ($row->getEstadopropuesta()) {
                case 0:
                    echo "<td>
                    <a href='../controller/gestionpropuesta_controller.php?action=accept_pincho&idnombre=" . $row->getIdnombre() . "'>Aceptar</a><br/>
                    <a href='../controller/gestionpropuesta_controller.php?action=deny_pincho&idnombre=" . $row->getIdnombre() . "'>Denegar</a>
                    </td>";
                    break;
                case 1:
                    echo "<td><a href='../controller/gestionpropuesta_controller.php?action=set_pendant&idnombre=" . $row->getIdnombre() . "'>Restablecer para revision</a></td>";
                    break;
                default:
                    echo "<td>Error por aqui</td>";
                    break;
            }

            echo "</tr>";
        }
    }
    ?>
    </tbody>

</table>

</body>
</html>
