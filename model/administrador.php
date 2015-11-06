<?php

class Administrador{
	
	private $idemail;
	private $nombre;
	private $contrasena;
	private $rutaavatar;

	public function __construct($idemail, $nombre, $contrasena, $rutaavatar){
		$this->idemail = $idemail;
		$this->nombre = $nombre;
		$this->contrasena = $contrasena;
		$this->rutaavatar = $rutaavatar;
	}

	



}

?>