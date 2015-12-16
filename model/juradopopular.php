<?php
include_once("usuario.php");
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
        UserMapper::comentar_pincho($pincho,$textcomentario,$this->idemail);
    }

    public function eliminar_comentario($idpincho){
        UserMapper::eliminar_comentario($idpincho,$this->idemail);
    }

    public function registerUser(){
        return UserMapper::registerUser($this);
    }

    public function votar_pincho($idpincho){
        UserMapper::votar_pincho($idpincho,$this->idemail);
    }
	
	public function getBaneado()
	{
		return $this->baneado;
	}
}

?>