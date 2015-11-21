<?php
include_once("./../resources/code/bd_manage.php");
include_once "concursoMapper.php";

class Concurso{
	private $idconcurso;
	private $descripcion;
	private $fecha;
	private $rutaportada;
	private $titulo; 


	//returns the only row in database, as an object
	public function __construct(){
		$this->idconcurso = ConcursoMapper::retrieveIdconcurso();
		$this->descripcion = ConcursoMapper::retrieveDescripcion();
		$this->fecha = ConcursoMapper::retrieveFecha();
		$this->rutaportada = ConcursoMapper::retrieveRutaportada();
		$this->titulo = ConcursoMapper::retrieveTitulo();

		if(!isset($this->idconcurso) || !isset($this->descripcion) || !isset($this->fecha) || !isset($this->rutaportada) || !isset($this->titulo)){
			throw new Exception('<<Concurso>> info inexistent in database or corrupted.');
		}
	}


	public function getIdconcurso(){
		return $this->idconcurso;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function getRutaportada(){
		return $this->rutaportada;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function getNumberOfPinchos(){
		return ConcursoMapper::retrieveNumPinchos();
	}

	public function getNumberOfUsers(){
		return ConcursoMapper::retrieveNumUsers();
	}

	public function getNumberOfEstablecimientos(){
		return ConcursoMapper::retrieveNumEstablecimientos();
	}

	public function getNumberOfVotosPopulares(){
		return ConcursoMapper::retrieveNumVotosPopulares();
	}

	public function getNumberOfComments(){
		return ConcursoMapper::retrieveNumComments();
	}

}
?>