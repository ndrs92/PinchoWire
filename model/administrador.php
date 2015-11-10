<?php

class Administrador extends Usuario{
	
	public function getDatos(){
        echo "Datos administrador: ".$this->getNombre()." ".$this->getIdmail();
    }
}

?>