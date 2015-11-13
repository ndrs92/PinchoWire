<?php

class Administrador extends Usuario{

    public function __construct($idemail, $nombre, $contrasena, $rutaavatar){
        parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
    }
	

}

?>