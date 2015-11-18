<?php

class JuradoProfesional extends Usuario{
	private $curriculum;
	private $baneado;

	public function __construct($idemail, $nombre, $contrasena, $rutaavatar, $curriculum, $baneado){
		parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
		$this->curriculum = $curriculum;
		$this->baneado = $baneado;
	}

	public function banFromDatabase()
	{
		UserMapper::banFromDatabase($this->idemail, strtolower(get_class($this)));
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