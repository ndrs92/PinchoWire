<?php
include_once("usuario.php");
class JuradoPopular extends Usuario{

    public function __construct($idemail, $nombre, $contrasena, $rutaavatar){
        parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
    }

    public function comentar_pincho($pincho, $textcomentario){
        //Abrir conexion BD
        include_once("./../resources/code/bd_manage.php");

        $date = date('Y-m-d');
        $query = "INSERT INTO comentario (juradopopular_idemail, pincho_idnombre, contenido, decha) VALUES ('$this->idmail','$pincho','$textcomentario', '$date');";
        echo($query);

        if(mysqli_query($query)){
            echo("Guardado satisfactorio");
        }
        else{echo("Error en el guardado");}
    }

    public function registerUser(){
        UserMapper::registerUser($this);
    }
}

?>