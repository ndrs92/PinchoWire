<?php

include_once "pinchoMapper.php";

class Pincho {
    private $idnombre;
    private $descripcion;
    private $precio;
    private $ingredientes;
    private $ganadorpopular;
    private $estadopropuesta;

    public function __construct($idnombre, $descripcion, $precio, $ingredientes, $ganadorpopular, $estadopropuesta){
        $this->idnombre = $idnombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->ingredientes = $ingredientes;
        $this->ganadorpopular = $ganadorpopular;
        $this->estadopropuesta = $estadopropuesta;
    }

    public static function getAllPinchos(){
        $mapperData = pinchoMapper::retrieveAll();
        

        foreach($mapperData as $toMake){
            $toRet[$toMake["idnombre"]] = new Pincho($toMake["idnombre"], $toMake["descripcion"], $toMake["precio"], $toMake["ingredientes"], $toMake["ganadorPopular"], $toMake["estadoPropuesta"], $toMake["establecimiento_idemail"]);
        }

        return $toRet;
    }

    public static function getByIdnombre($idnombre){
        $mapperData = pinchoMapper::find($idnombre);

        return new Pincho($mapperData["idnombre"], $mapperData["descripcion"], $mapperData["precio"], $mapperData["ingredientes"], $mapperData["ganadorPopular"], $mapperData["estadoPropuesta"], $mapperData["establecimiento_idemail"]);
    }

    public function getAllComentarios(){
        return pinchoMapper::retrieveAllComentarios($this->getIdnombre());
    }

    public function getIdnombre()
    {
        return $this->idnombre;
    }

    public function setIdnombre($idnombre)
    {
        $this->idnombre = $idnombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getIngredientes()
    {
        return $this->ingredientes;
    }

    public function setIngredientes($ingredientes)
    {
        $this->ingredientes = $ingredientes;
    }

    public function getGanadorpopular()
    {
        return $this->ganadorpopular;
    }

    public function setGanadorpopular($ganadorpopular)
    {
        $this->ganadorpopular = $ganadorpopular;
    }

    public function getEstadopropuesta()
    {
        return $this->estadopropuesta;
    }

    public function setEstadopropuesta($estadopropuesta)
    {
        $this->estadopropuesta = $estadopropuesta;
    }
}

?>