<?php

include_once("../resources/code/bd_manage.php");


class UserMapper
{
    public static function findByEmailAdmin($idemail){
        global $connectHandler;
        $result = mysqli_query($connectHandler, "SELECT * FROM `administrador` WHERE `idemail`=\"$idemail\"");


        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return new Administrador($row["idemail"], $row["nombre"], $row["contrasena"], $row["rutaavatar"]);

        } else {
            return NULL;
        }
    }

    public static function isValidUser($idemail, $passwd){
        global $connectHandler;
        $result = mysqli_query($connectHandler, "SELECT * FROM juradopopular WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

        if (mysqli_num_rows($result) > 0) {
            //Es jurado popular
            $row = mysqli_fetch_assoc($result);
            return "juradopopular";
        } else {
            $result = mysqli_query($connectHandler, "SELECT * FROM juradoprofesional WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

            if (mysqli_num_rows($result) > 0) {
                //Es juradoprofesional
                $row = mysqli_fetch_assoc($result);
                return "juradoprofesional";

            } else {
                $result = mysqli_query($connectHandler, "SELECT * FROM establecimiento WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

                if (mysqli_num_rows($result) > 0) {
                    //Es establecimiento
                    $row = mysqli_fetch_assoc($result);
                    return "establecimiento";

                } else {
                    $result = mysqli_query($connectHandler, "SELECT * FROM administrador WHERE idemail=\"$idemail\" AND contrasena=\"$passwd\"");

                    if (mysqli_num_rows($result) > 0) {
                        //Es administrador
                        $row = mysqli_fetch_assoc($result);
                        return "administrador";
                    }

                }
            }
        }
        return null; //No es nadie
    }

}

?>