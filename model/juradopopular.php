<?php
include_once("usuario.php");
include_once("juradopopularMapper.php");
class JuradoPopular extends Usuario{

    public function __construct($idemail, $nombre, $contrasena, $rutaavatar){
        parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
    }

    public function comentar_pincho($pincho, $textcomentario){
        JuradoPopularMapper::comentar_pincho($pincho,$textcomentario,$this->idemail);
    }

    public function eliminar_comentario($idpincho){
        JuradoPopularMapper::eliminar_comentario($idpincho,$this->idemail);
    }

    public function registerUser(){
        UserMapper::registerUser($this);
    }
}

?>