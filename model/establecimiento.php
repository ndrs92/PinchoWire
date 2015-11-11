<?php
include_once "usuario.php";
include_once("./../resources/code/bd_manage.php");

class Establecimiento extends Usuario{
	private $direccion;
	private $web;
	private $horario;
	private $rutaimagen;
	private $geoloc;

	public function __construct($idemail, $nombre, $contrasena, $rutaavatar, $direccion, $web, $horario, $rutaimagen, $geoloc){
		parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
		$this->direccion = $direccion;
		$this->web = $web;
		$this->horario = $horario;
		$this->rutaimagen = $rutaimagen;
		$this->geoloc = $geoloc;
	}

	public function enviar_propuesta($nombre, $descripcion, $ingredientes, $precio){
		//Abrir conexion BD
		global $connectHandler;
		if (!$connectHandler) {
    		die("Connection failed: " . mysqli_connect_error());
		}
		
		$query = "INSERT INTO pincho (idnombre, descripcion, ingredientes, precio, estadoPropuesta, ganadorPopular, establecimiento_idemail) VALUES ('$nombre','$descripcion','$ingredientes', $precio, 0, null,'$this->idmail');";
		echo($query);

		if(mysqli_query($connectHandler, $query)){
			echo("Guardado satisfactorio");
		}  
		else{echo("Error en el guardado");}
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
}

?>