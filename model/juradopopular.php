<?php
include_once("usuario.php");
include_once("juradopopularMapper.php");
class JuradoPopular extends Usuario{
	private $baneado;
	
    public function __construct($idemail, $nombre, $contrasena, $rutaavatar, $baneado){
        parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
		$this->baneado = $baneado;
    }

    public function editBanFromDatabase($banned){
        UserMapper::editBanFromDatabase($this->idemail, strtolower(get_class($this)), $banned);
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
	
	public function getBaneado()
	{
		return $this->baneado;
	}
}

?>