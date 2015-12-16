<?php 
include_once "../resources/code/bd_manage.php";
include_once "concursoMapper.php";
 
class Concurso{
	private $idconcurso;
	private $descripcion;
	private $fecha;
	private $rutaportada;
	private $titulo; 
	private $estado; 
	private $facebook; 
	private $twitter; 
	private $googleplus; 
	private $numFinalistas;


	//returns the only row in database, as an object
	public function __construct(){
		$this->idconcurso = ConcursoMapper::retrieveIdconcurso();
		$this->descripcion = ConcursoMapper::retrieveDescripcion();
		$this->fecha = ConcursoMapper::retrieveFecha();
		$this->rutaportada = ConcursoMapper::retrieveRutaportada();
		$this->titulo = ConcursoMapper::retrieveTitulo();
		$this->estado = ConcursoMapper::retrieveEstado();
		$this->facebook = ConcursoMapper::retrieveFacebook();
		$this->twitter = ConcursoMapper::retrieveTwitter();
		$this->googleplus = ConcursoMapper::retrieveGoogleplus();
		$this->numFinalistas = ConcursoMapper::retrieveNumFinalistas();

		if(!isset($this->idconcurso) || !isset($this->descripcion) || !isset($this->fecha) || !isset($this->rutaportada) || !isset($this->titulo) || !isset($this->titulo)  || !isset($this->estado) || !isset($this->numFinalistas)){
			throw new Exception('<<Concurso>> info inexistent in database or corrupted.');
		}
	}

	public function setEstado($value){
		if(ConcursoMapper::updateEstado($value)){
			$this->estado = $value;
		}else{
			throw new Exception("There was a problem updating competition actual state");
		}
	}
	public function setFinalistas($num){
		if(ConcursoMapper::updateFinalistas($num)){
			$this->numFinalistas = $num;
		}else{
			throw new Exception("There was a problem updating competition actual finalist number");
		}
	}

	public function getFinalistas(){
		return ConcursoMapper::crearFinalistas($this->numFinalistas);
	} 

	public function setGanadorProfesional($num){
		ConcursoMapper::setGanadorProfesional($num);
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

	public function getEstado(){
		return $this->estado;
	}

	public function getFacebook(){
		return $this->facebook;
	}

	public function getTwitter(){
		return $this->twitter;
	}

	public function getGoogleplus(){
		return $this->googleplus;
	}

	public function getNumFinalistas(){
		return $this->numFinalistas;
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

	public function getMeanPrice(){
		return ConcursoMapper::retrieveMeanPrice();
	}

	public function getTotalConsumptions(){
		return ConcursoMapper::retrieveTotalConsumptions();
	}

	public function getTotalGastado(){
		return ConcursoMapper::retrieveTotalSpent();
	}

}
?>