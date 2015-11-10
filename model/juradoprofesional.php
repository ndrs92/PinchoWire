<?php

class JuradoProfesional extends Usuario{
	private $curriculum;

	public function __construct($idemail, $nombre, $contrasena, $rutaavatar, $curriculum){
		parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
		$this->curriculum = $curriculum;
	}

	public function getCurriculum()
	{
		return $this->curriculum;
	}

	public function setCurriculum($curriculum)
	{
		$this->curriculum = $curriculum;
	}
}

?>