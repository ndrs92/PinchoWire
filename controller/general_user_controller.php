<?php

include_once "../model/usuario.php";

/**
 * Created by PhpStorm.
 * User: ndrs
 * Date: 14/11/2015
 * Time: 17:11
 */

function getAllUsuarios(){
    return Usuario::getAllUsuarios();
}