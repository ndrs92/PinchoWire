<?php
 
include_once("../resources/code/bd_manage.php");


class UserMapper
{
    public static function eliminar_comentario($idpincho, $idemail)
    {
        //Abrir conexion BD
        global $connectHandler;
        $query = "DELETE FROM comentario WHERE (idcomentario = $idpincho)";
        echo($query);

        if (mysqli_query($connectHandler, $query)) {
            echo("Comentario eliminado satisfactoriamente");
        } else {
            echo("Error en el eliminado del pincho");
        }
    }

    public static function editBanFromDatabase($idemail, $usertype, $banned)
    {
        global $connectHandler;
        $query = "UPDATE " . $usertype . " SET baneado = '" . $banned . "' WHERE idemail='" . $idemail . "'";

        $status = mysqli_query($connectHandler, $query);
        if ($status == true) {
            return;
        } else {
            echo "Error. Fallo de baneación.";
            exit();
        }
    }

    public static function retrieveAll()
    {
        global $connectHandler;
        $query = "Select * from juradopopular";
        $result = mysqli_query($connectHandler, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $toRet["juradopopular"][$row["idemail"]] = $row;
        }

        $query = "Select * from juradoprofesional";
        $result = mysqli_query($connectHandler, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $toRet["juradoprofesional"][$row["idemail"]] = $row;
        }

        $query = "Select * from establecimiento";
        $result = mysqli_query($connectHandler, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $toRet["establecimiento"][$row["idemail"]] = $row;
        }

        return $toRet;
    }

    public static function retriveAllJuradoProfesional()
    {
        global $connectHandler;
        $query = "Select * from juradoprofesional";
        $result = mysqli_query($connectHandler, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $toRet[$row["idemail"]] = $row;
        }
        return $toRet;
    }

    public static function votacionPromociona($idemail, $pincho, $puntuacion){
        global $connectHandler;
        $query = "INSERT INTO promociona VALUES('$idemail', '$pincho', $puntuacion)";
        $result = mysqli_query($connectHandler, $query);
        return $result;

    }

    public static function retrieveAllEstablecimientos()
    {
        global $connectHandler;
        $query = "Select * from establecimiento";
        $result = mysqli_query($connectHandler, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $toRet[$row["idemail"]] = $row;
        }

        return $toRet;
    }

    public static function retrievePinchosAsignados($idemail)
    {
        global $connectHandler;
        $query = "SELECT juradoprofesional_idemail, idnombre, establecimiento_idemail FROM asignado, pincho WHERE asignado.juradoprofesional_idemail= '" . $idemail . "' AND pincho.idnombre = asignado.pincho_idnombre";
        $result = mysqli_query($connectHandler, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $toRet[$row["idnombre"]] = $row;
        }

        return $toRet;
    }


    public static function registerUser($userObject)
    {
        global $connectHandler;
        $result = false;

        if (get_class($userObject) == "JuradoPopular") {
            $query = "Insert into juradopopular values('" . $userObject->getIdemail() . "','" . $userObject->getNombre() . "','" . $userObject->getContrasena() . "','" . $userObject->getRutaavatar() . "','" . $userObject->getBaneado() . "')";
            $result = mysqli_query($connectHandler, $query);
        } else if (get_class($userObject) == "Establecimiento") {
            $query = "Insert into establecimiento values('" . $userObject->getIdemail() . "','" . $userObject->getNombre() . "','" . $userObject->getContrasena() . "','" . $userObject->getRutaavatar() . "','" . $userObject->getDireccion() . "','" . $userObject->getWeb() . "','" . $userObject->getHorario() . "','" . $userObject->getRutaimagen() . "','" . $userObject->getGeoloc() . "','" . $userObject->getBaneado() . "')";
            $result = mysqli_query($connectHandler, $query);
        } else if (get_class($userObject) == "JuradoProfesional") {
            $query = "Insert into juradoprofesional values('" . $userObject->getCurriculum() . "','" . $userObject->getIdemail() . "','" . $userObject->getNombre() . "','" . $userObject->getContrasena() . "','" . $userObject->getRutaavatar() . "','" . $userObject->getBaneado() . "')";
            $result = mysqli_query($connectHandler, $query);
        }

        return $result;
    }

    public static function findByEmail($idemail, $usertype)
    {
        global $connectHandler;
        $result = mysqli_query($connectHandler, "SELECT * FROM $usertype WHERE `idemail`=\"$idemail\"");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            switch ($usertype) {
                case "administrador":
                    $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"]);
                    break;
                case "juradoprofesional":
                    $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"], $row["curriculum"], $row["baneado"]);
                    break;
                case "juradopopular":
                    $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"], $row["baneado"]);
                    break;
                case "establecimiento":
                    $user = new $usertype($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"], $row["direccion"], $row["web"], $row["horario"], $row["rutaimagen"], $row["geoloc"], $row["baneado"]);
                    break;
            }

            return $user;

        } else {
            return NULL;
        }
    }

    public static function isValidUser($idemail, $passwd)
    {
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

    public static function update($mail, $pass, $name, $avatar, $typeuser, $curriculum, $direccion, $web, $horario, $imagen, $geoloc)
    {
        global $connectHandler;

        switch ($typeuser) {
            case "administrador":
                $result = mysqli_query($connectHandler, "UPDATE administrador
            SET idemail=\"$mail\",
            nombre=\"$name\",
            contrasena=\"$pass\",
            rutaavatar=\"$avatar\"
            WHERE idemail=\"$mail\"");
                break;

            case "juradoprofesional":
                $lastmail = $_SESSION["user"]->getIdemail();
                $result = mysqli_query($connectHandler, "UPDATE juradoprofesional
            SET idemail=\"$mail\",
            nombre=\"$name\",
            contrasena=\"$pass\",
            rutaavatar=\"$avatar\",
            curriculum=\"$curriculum\"
            WHERE idemail=\"$mail\"");
                break;

            case "juradopopular":
                $lastmail = $_SESSION["user"]->getIdemail();
                $result = mysqli_query($connectHandler, "UPDATE juradopopular
            SET idemail=\"$mail\",
            nombre=\"$name\",
            contrasena=\"$pass\",
            rutaavatar=\"$avatar\"
            WHERE idemail=\"$mail\"");
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
            WHERE idemail=\"$mail\"");
                break;


        }
    }


    public static function havePinchoAccepted($idemail)
    {
        global $connectHandler;
        $query = "SELECT * FROM pincho WHERE establecimiento_idemail = '$idemail' AND estadoPropuesta = 2";
        if ($result = mysqli_query($connectHandler, $query)) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return $row;
        }
    }


    public static function havePropuesta($idemail)
    {
        global $connectHandler;
        $query = "SELECT * FROM pincho WHERE establecimiento_idemail = '$idemail' ";
        if ($result = mysqli_query($connectHandler, $query)) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return $row;
        }
    }

    public static function assignPinchoJuradoProfesional($idemail, $pincho)
    {
        global $connectHandler;
        $query = "INSERT INTO asignado VALUES('" . $idemail . "', '" . $pincho . "') ";
        $result = mysqli_query($connectHandler, $query);
        return $result;

    }

    public static function isAssignedPinchoJuradoProfesional($idemail, $pincho)
    {
        global $connectHandler;
        $query = "SELECT * FROM asignado WHERE juradoprofesional_idemail='" . $idemail . "' AND pincho_idnombre='" . $pincho . "';";
        $result = mysqli_query($connectHandler, $query) or die("Error en isAssignedPinchoJuradoProfesional() mapper");
        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            return true;
        }

    }

    public static function retrievePinchosVotadosDePromociona($idemail)
    {
        global $connectHandler;
        $query = "SELECT * FROM promociona WHERE juradoprofesional_idemail='".$idemail."'";
        $result = mysqli_query($connectHandler, $query) or die("Error en retrievePinchosVotadosDePromociona mapper");
        while ($row = mysqli_fetch_assoc($result)) {
            $toRet[$row["pincho_idnombre"]] = $row;
        }

        return $toRet;
    }

}

?>