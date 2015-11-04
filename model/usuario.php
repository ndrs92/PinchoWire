<?php

include_once "./juradopopular.php";
include_once "./juradoprofesional.php";
include_once "./administrador.php";
include_once "./establecimiento.php";


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


		return "Could not log in user - Not implemented";
	}

}


?>