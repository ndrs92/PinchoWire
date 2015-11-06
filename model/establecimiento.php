<?php

class Establecimiento{
	
	private $idemail;
	private $nombre;
	private $contrasena;
	private $rutaavatar;
	private $direccion;
	private $web;
	private $horario;
	private $rutaimagen;	
	private $geoloc;

	public function __construct($idemail, $nombre, $contrasena, $rutaavatar){
		$this->idemail = $idemail;
		$this->nombre = $nombre;
		$this->contrasena = $contrasena;
		$this->rutaavatar = $rutaavatar;
		$this->direccion = $direccion;
		$this->web = $web;
		$this->horario = $horario;
		$this->rutaimagen = $rutaimagen;
		$this->geoloc = $geoloc;
	}

	
	



}

?>