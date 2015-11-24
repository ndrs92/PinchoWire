<?php
include_once "../resources/code/models.php";
if(!isset($_SESSION)) session_start();

$concurso = new Concurso();

if(get_class($_SESSION["user"])!="Administrador" || $concurso->getEstado() == 3){
    header("Location: ../view/403.php");
    exit;
}


$estadoActual = $concurso->getEstado();

$estadoActual++;

$concurso->setEstado($estadoActual);

header("Location: ../view/view_admin_concurso.php");



?>