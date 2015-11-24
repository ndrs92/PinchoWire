<?php
 
include_once "pinchoMapper.php";

class Pincho {
    private $idnombre;
    private $descripcion;
    private $precio;
    private $ingredientes;
    private $ganadorpopular;
    private $estadopropuesta;
    private $rutaimagen;

    public function __construct($idnombre, $descripcion, $precio, $ingredientes, $ganadorpopular, $estadopropuesta, $rutaimagen){
        $this->idnombre = $idnombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->ingredientes = $ingredientes;
        $this->ganadorpopular = $ganadorpopular;
        $this->estadopropuesta = $estadopropuesta;
        $this->rutaimagen = $rutaimagen;
    }

    public static function search($search_data){
        $toRet = NULL;
        $toSearch = PinchoMapper::retrieveAllAceptados();
        if($toSearch == NULL){
            return NULL;
        }else{
            foreach($toSearch as $p){
                if(strpos(strtolower($p["idnombre"]), $search_data) != false || strpos(strtolower($p["descripcion"]), $search_data) != false || strpos(strtolower($p["ingredientes"]), $search_data) != false){
                    $toRet[$p["idnombre"]] = new Pincho($p["idnombre"], $p["descripcion"], $p["precio"], $p["ingredientes"], $p["ganadorPopular"], $p["estadoPropuesta"], $p["establecimiento_idemail"]);
                }
            }
        }

        return $toRet;
    }

    public function getEstablishment(){
        $pincho = PinchoMapper::find($this->getIdnombre());
        $idmail = $pincho["establecimiento_idemail"];
        return Usuario::getByIdemail($idmail);
    }

    public function createCodes($numberOfCodes){
        for($i = 0; $i < $numberOfCodes; $i++){
            $code = uniqid();
            PinchoMapper::createCodeForPincho($code, $this->getIdnombre());
        }
    }

    public function getAllCodes(){
        $mapperData = pinchoMapper::retrieveAllCodes($this->getIdnombre());

        $toRet = NULL;
        if($mapperData != NULL) {
            $toRet = $mapperData;
        }
        return $toRet;
    } 

    public function getRetrievedCodes(){
        $mapperData = pinchoMapper::retrieveRetrievedCodes($this->getIdnombre());
        $toRet = NULL;
        if($mapperData != NULL) {
            $toRet = $mapperData;
        }
        return $toRet;
    }

    public function getAvailableCodes(){
        $mapperData = pinchoMapper::retrieveUnusedCodes($this->getIdnombre());
        $toRet = NULL;
        if($mapperData != NULL) {
            $toRet = $mapperData;
        }
        return $toRet; 
    }

    public static function getAllPropuestas(){
        $mapperData = pinchoMapper::retrieveAllPropuestas();

        $toRet = NULL;
        if($mapperData != NULL) {
            foreach ($mapperData as $toMake) {
                $toRet[$toMake["establecimiento_idemail"]] = new Pincho($toMake["idnombre"], $toMake["descripcion"], $toMake["precio"], $toMake["ingredientes"], $toMake["ganadorPopular"], $toMake["estadoPropuesta"], $toMake["establecimiento_idemail"]);
            }
        }
        return $toRet;
    }

    public static function getAllPinchos(){
        $mapperData = pinchoMapper::retrieveAllAceptados();

        $toRet = NULL;
        if($mapperData != NULL) {
            foreach ($mapperData as $toMake) {
                $toRet[$toMake["establecimiento_idemail"]] = new Pincho($toMake["idnombre"], $toMake["descripcion"], $toMake["precio"], $toMake["ingredientes"], $toMake["ganadorPopular"], $toMake["estadoPropuesta"], $toMake["rutaimagen"]);
            }
        }
        return $toRet;
    }

    public static function getByIdnombre($idnombre){
        $mapperData = pinchoMapper::find($idnombre);

        return new Pincho($mapperData["idnombre"], $mapperData["descripcion"], $mapperData["precio"], $mapperData["ingredientes"], $mapperData["ganadorPopular"], $mapperData["estadoPropuesta"], $mapperData["rutaimagen"]);
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
        PinchoMapper::updateEstado($this->getEstadopropuesta(), $this->getIdnombre());
    }

    public function getRutaimagen()
    {
        return $this->rutaimagen;
    }
}

?>