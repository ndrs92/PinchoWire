<?php
include_once("usuario.php");
class JuradoPopular extends Usuario{

    public function __construct($idemail, $nombre, $contrasena, $rutaavatar){
        parent::__construct($idemail, $nombre, $contrasena, $rutaavatar);
    }

    public function comentar_pincho($pincho, $textcomentario){
        //Abrir conexion BD
        include_once("./../resources/code/bd_manage.php");
        global $connectHandler;
        $date = date('Y-m-d');
        $query = "INSERT INTO comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('$this->idemail','$pincho','$textcomentario', '$date')";
        echo($query);

        if(mysqli_query($connectHandler, $query)){
            echo("Guardado satisfactorio");
        }
        else{echo("Error en el guardado");}
    }

    public function eliminar_pincho($idpincho){
        //Abrir conexion BD
        include_once("./../resources/code/bd_manage.php");
        global $connectHandler;
        $query = "DELETE FROM comentario WHERE (idcomentario = $idpincho AND juradopopular_idemail = '$this->idemail')";
        echo($query);

        if(mysqli_query($connectHandler, $query)){
            echo("Comentario eliminado satisfactoriamente");
        }
        else{echo("Error en el eliminado del pincho");}
    }

    public function registerUser(){
        UserMapper::registerUser($this);
    }
}

?>