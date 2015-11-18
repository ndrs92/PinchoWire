<?php
include_once "usuario.php";
include_once("./../resources/code/bd_manage.php");
include_once("pinchoMapper.php");
include_once("pincho.php");

class Establecimiento extends Usuario{
	private $direccion;
	private $web;
	private $horario;
	private $rutaimagen;
	private $geoloc;
	private $baneado;

	public function __construct($idemail, $nombre, $contrasena, $rutaavatar, $direccion, $web, $horario, $rutaimagen, $geoloc, $baneado){
		parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
		$this->direccion = $direccion;
		$this->web = $web;
		$this->horario = $horario;
		$this->rutaimagen = $rutaimagen;
		$this->geoloc = $geoloc;
		$this->baneado = $baneado;
	}

	public function banFromDatabase()
	{
		UserMapper::banFromDatabase($this->idemail, strtolower(get_class($this)));
	}

	public function registerUser(){
		UserMapper::registerUser($this);
	}

	public function enviar_propuesta($nombre, $descripcion, $ingredientes, $precio){
		//Abrir conexion BD $this->idemail
		
		return PinchoMapper::addPropuesta($nombre, $descripcion, $ingredientes, $precio, $this->idemail); 
	}
	public function editar_propuesta($nombre, $descripcion, $ingredientes, $precio){
		return PinchoMapper::editPropuesta($nombre, $descripcion, $ingredientes, $precio, $this->idemail);
	}
	public function havePropuesta(){
		return UserMapper::havePropuesta($this->idemail);
	}

	public function havePinchoAccepted(){
		return UserMapper::havePinchoAccepted($this->idemail);
	}

	public function getAssociatedPincho(){
		$target = PinchoMapper::getPinchoByIdemail($this->idemail);
		if(isset($target)){
			return new Pincho($target["idnombre"], $target["descripcion"], $target["precio"], $target["ingredientes"], $target["ganadorPopular"], $target["estadoPropuesta"] );
		}else{
			return NULL;
		}
	}

	public function getDireccion()
	{
		return $this->direccion;
	}

	public function getGeoloc()
	{
		return $this->geoloc;
	}

	public function getHorario()
	{
		return $this->horario;
	}

	public function getRutaimagen()
	{
		return $this->rutaimagen;
	}

	public function getWeb()
	{
		return $this->web;
	}
	
	public function getBaneado()
	{
		return $this->baneado;
	}
}

?>