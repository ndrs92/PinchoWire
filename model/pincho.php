<?php

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