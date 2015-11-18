<?php

include_once "../model/usuario.php";

/**
 * Created by PhpStorm.
 * User: ndrs
 * Date: 14/11/2015
 * Time: 17:11
 */
session_start();
if(get_class($_SESSION["user"])!="Administrador"){
    header("Location: ../view/403.php");
    exit;
}

function getAllUsuarios(){
    return Usuario::getAllUsuarios();
}