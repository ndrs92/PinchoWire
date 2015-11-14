<?php

include_once("../resources/code/bd_manage.php");


class UserMapper{

  public static function deleteFromDatabase($idemail, $usertype){
    global $connectHandler;
    $query = "Delete from ".$usertype." where idemail='".$idemail."'";

    $status = mysqli_query($connectHandler, $query);
    if($status == true){
      return;
    }else{
      echo "error, probablemente existan comentarios o informacion para borrar en cascada en este usuario. hay que arreglar eso";
      exit();;
    }
  }

  public static function retrieveAll(){
      global $connectHandler;
      $query = "Select * from juradopopular";
      $result = mysqli_query($connectHandler, $query);
      while($row = mysqli_fetch_assoc($result)){
        $toRet["juradopopular"][$row["idemail"]] = $row;
      }

      $query = "Select * from juradoprofesional";
      $result = mysqli_query($connectHandler, $query);
      while($row = mysqli_fetch_assoc($result)){
        $toRet["juradoprofesional"][$row["idemail"]] = $row;
      }

      $query = "Select * from establecimiento";
      $result = mysqli_query($connectHandler, $query);
      while($row = mysqli_fetch_assoc($result)){
        $toRet["establecimiento"][$row["idemail"]] = $row;
      }

      return $toRet;
  }

  public static function registerUser($userObject){
    global $connectHandler;

    if(get_class($userObject) == "JuradoPopular"){
      $query = "Insert into juradopopular values('".$userObject->getIdemail()."','".$userObject->getNombre()."','".$userObject->getContrasena()."','".$userObject->getRutaavatar()."')";
      $result = mysqli_query($connectHandler, $query);
    }else{
      $query = "Insert into establecimiento values('".$userObject->getIdemail()."','".$userObject->getNombre()."','".$userObject->getContrasena()."','".$userObject->getRutaavatar()."','".$userObject->getDireccion()."','".$userObject->getWeb()."','".$userObject->getHorario()."','".$userObject->getRutaimagen()."','".$userObject->getGeoloc()."')";
      $result = mysqli_query($connectHandler, $query);
      
    }

  }

  public static function findByEmail($idemail, $usertype){
    global $connectHandler;
    $result = mysqli_query($connectHandler, "SELECT * FROM $usertype WHERE `idemail`=\"$idemail\"");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      switch($usertype) {
        case "administrador":
        $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"]);
        break;
        case "juradoprofesional":
        $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"], $row["curriculum"]);
        break;
        case "juradopopular":
        $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"]);
        break;
        case "establecimiento":
        $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"], $row["direccion"], $row["web"], $row["horario"], $row["rutaimagen"], $row["geoloc"]);
        break;
      }

      return $user;

    } else {
      return NULL;
    }
  }

  public static function isValidUser($idemail, $passwd){
    global $connectHandler;
    $result = mysqli_query($connectHandler, "SELECT * FROM juradopopular WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

    if (mysqli_num_rows($result) > 0) {
            //Es jurado popular
      return "juradopopular";
    } else {
      $result = mysqli_query($connectHandler, "SELECT * FROM juradoprofesional WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

      if (mysqli_num_rows($result) > 0) {
                //Es juradoprofesional
        return "juradoprofesional";

      } else {
        $result = mysqli_query($connectHandler, "SELECT * FROM establecimiento WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

        if (mysqli_num_rows($result) > 0) {
                    //Es establecimiento
          return "establecimiento";

        } else {
          $result = mysqli_query($connectHandler, "SELECT * FROM administrador WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

          if (mysqli_num_rows($result) > 0) {
                        //Es administrador
            return "administrador";
          }

        }
      }
    }
        return null; //No es nadie
  }

      public static function update($mail, $pass, $name, $avatar, $typeuser, $curriculum, $direccion, $web, $horario, $imagen, $geoloc){
        global $connectHandler;

        switch($typeuser){
          case "administrador":
          $lastmail = $_SESSION["user"]->getIdemail();
          $result = mysqli_query($connectHandler, "UPDATE administrador
            SET idemail=\"$mail\",
            nombre=\"$name\",
            contrasena=\"$pass\",
            rutaavatar=\"$avatar\"
            WHERE idemail=\"$lastmail\"");
          break;

          case "juradoprofesional":
          $lastmail = $_SESSION["user"]->getIdemail();
          $result = mysqli_query($connectHandler, "UPDATE juradoprofesional
            SET idemail=\"$mail\",
            nombre=\"$name\",
            contrasena=\"$pass\",
            rutaavatar=\"$avatar\",
            curriculum=\"$curriculum\"
            WHERE idemail=\"$lastmail\"");
          break;

          case "juradopopular":
          $lastmail = $_SESSION["user"]->getIdemail();
          $result = mysqli_query($connectHandler, "UPDATE juradopopular
            SET idemail=\"$mail\",
            nombre=\"$name\",
            contrasena=\"$pass\",
            rutaavatar=\"$avatar\"
            WHERE idemail=\"$lastmail\"");
          break;

          case "establecimiento":
          $lastmail = $_SESSION["user"]->getIdemail();
          $result = mysqli_query($connectHandler, "UPDATE establecimiento
            SET idemail=\"$mail\",
            nombre=\"$name\",
            contrasena=\"$pass\",
            rutaavatar=\"$avatar\",
            geoloc=\"$geoloc\",
            direccion=\"$direccion\",
            web=\"$web\",
            horario=\"$horario\",
            rutaimagen=\"$imagen\"
            WHERE idemail=\"$lastmail\"");
          break;


        }
      }

      public static function havePropuesta($idemail){
        global $connectHandler;
        $query="SELECT * FROM pincho WHERE establecimiento_idemail = '$idemail' "; 
        if($result = mysqli_query($connectHandler, $query)){
          $row=mysqli_fetch_assoc($result);
          return $row;
        }  
        else{
          return $row;     
        }
      }

    }

    ?>