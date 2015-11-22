<?php

include_once "../model/usuario.php";
include_once "../model/establecimiento.php";

/**
 * Created by PhpStorm.
 * User: ndrs
 * Date: 14/11/2015
 * Time: 17:11
 */
session_start();


function getAllUsuarios(){
    return Usuario::getAllUsuarios();
}

function getAllEstablecimientos(){
    return Establecimiento::getAll();
}


function getUsuarioById($idemail){
	return Usuario::getByIdemail($idemail);
}