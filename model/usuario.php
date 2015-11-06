<?php

include_once "juradopopular.php";
include_once "juradoprofesional.php";
include_once "administrador.php";
include_once "establecimiento.php";


/*
This should be an purely helper class. The way in which our desing dictates functionality makes sense to not use this class as 
prototype for objects, as it is not present in database persistency.

Said that, this class should provide static methods used to help user-related tasks, such as knowing which type of user
is each one, and maybe some common tasks.

It is possible to establish this class as parent of JuradoPopular and so on. Need to talk it.

*/

class Usuario{
	
	//Returns error string if failed to login
	//Returns an object representing the user if all goes well
	//Object returned will be enough to know which kind of user is that which logged in
	public static function login_user($user, $pass){
		if($user && $pass){
			//connect to db
			include_once "../resources/code/bd_manage.php";

			//select data
			$result = mysqli_query("SELECT * FROM juradopopular WHERE idemail = $user");

			if(mysqli_fetch_array($result)){
				//significa que es jurado popular
			}else{
				$result = mysqli_query("SELECT * FROM juradoprofesional WHERE idemail = $user");
				if(mysqli_fetch_array($result)){
					//significa que es jurado profesional
				}else{
					$result = mysqli_query("SELECT * FROM establecimiento WHERE idemail = $user");
					if(mysqli_fetch_array($result)){
						//significa que es establecimiento
					}else{
						$result = mysqli_query("SELECT * FROM administrador WHERE idemail = $user");
						if(mysqli_fetch_array($result)){
							//significa que es administrador
						}else{
							//Error, no se ha encontrado el usuario
						}
					}
				}

			}


			//compare data

			//instance correct type of user


			//return user object



		}else{
			return "error, fields not validated";

		}
	}

}


?>