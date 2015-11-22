<?php

include_once "../model/usuario.php";

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

function getUsuarioById($idemail){
	return Usuario::getByIdemail($idemail);
}