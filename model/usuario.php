<?php

include_once "juradopopular.php";
include_once "juradoprofesional.php";
include_once "administrador.php";
include_once "establecimiento.php";
include_once "userMapper.php";


/*
This should be an purely helper class. The way in which our desing dictates functionality makes sense to not use this class as 
prototype for objects, as it is not present in database persistency.

Said that, this class should provide static methods used to help user-related tasks, such as knowing which type of user
is each one, and maybe some common tasks.

It is possible to establish this class as parent of JuradoPopular and so on. Need to talk it.

*/

class Usuario{
	protected $idmail;
	protected $nombre;
	protected $contrasena;
	protected $rutaavatar;

	public function __construct($idmail, $nombre, $contrasena, $rutaavatar){
		$this->idmail = $idmail;
		$this->contrasena = $contrasena;
		$this->nombre = $nombre;
		$this->rutaavatar = $rutaavatar;
	}

	//Returns error string if failed to login
	//Returns an object representing the user if all goes well
	//Object returned will be enough to know which kind of user is that which logged in
	public static function login_user($user, $pass){
		if($user && $pass){
			if ($usertype = UserMapper::isValidUser($user, $pass)) {
				return UserMapper::findByEmail($user, $usertype);
			} else {
				echo "ERROR: user or password incorrect";
			}
		}else{
			return "error, fields not validated";

		}
	}

	public static function getAllUsuarios(){
		$dataset = UserMapper::retrieveAll();
		foreach($dataset["juradopopular"] as $parsed){
			$toRet[$parsed["idemail"]] = new JuradoPopular($parsed["idemail"], $parsed["nombre"], $parsed["contrasena"], $parsed["rutaavatar"]);
		}

		foreach($dataset["juradoprofesional"] as $parsed){
			$toRet[$parsed["idemail"]] = new JuradoProfesional($parsed["idemail"], $parsed["nombre"], $parsed["contrasena"], $parsed["rutaavatar"], $parsed["curriculum"] );
		}

		foreach($dataset["establecimiento"] as $parsed){
			$toRet[$parsed["idemail"]] = new Establecimiento($parsed["idemail"], $parsed["nombre"], $parsed["contrasena"], $parsed["rutaavatar"], $parsed["direccion"], $parsed["web"], $parsed["horario"], $parsed["rutaimagen"], $parsed["geoloc"]);
		}

		return $toRet;

	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getIdmail()
	{
		return $this->idmail;
	}

	public function getContrasena()
	{
		return $this->contrasena;
	}

	public function getRutaavatar()
	{
		return $this->rutaavatar;
	}

	public function setContrasena($contrasena)
	{
		$this->contrasena = $contrasena;
	}

	public function setIdmail($idmail)
	{
		$this->idmail = $idmail;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function setRutaavatar($rutaavatar)
	{
		$this->rutaavatar = $rutaavatar;
	}
}


?>