<?php
include_once "../model/usuario.php";

class Administrador extends Usuario{

    public function __construct($idemail, $nombre, $contrasena, $rutaavatar){
        parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
    }

    public function eliminar_comentario($idpincho){
        UserMapper::eliminar_comentario($idpincho,$this->idemail);
    }

    public function getBaneado(){
        return "0";
    }

}

?>