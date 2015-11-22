<?php

class JuradoProfesional extends Usuario{
	private $curriculum;
	private $baneado;

	public function __construct($idemail, $nombre, $contrasena, $rutaavatar, $curriculum, $baneado){
		parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
		$this->curriculum = $curriculum;
		$this->baneado = $baneado;
	}

	public function editBanFromDatabase($banned){
		UserMapper::editBanFromDatabase($this->idemail, strtolower(get_class($this)), $banned);
	}

	public function registerUser(){
		return UserMapper::registerUser($this);
	}

	public function getCurriculum()
	{
		return $this->curriculum;
	}

	public function setCurriculum($curriculum)
	{
		$this->curriculum = $curriculum;
	}
	
	public function getBaneado()
	{
		return $this->baneado;
	}

}

?>