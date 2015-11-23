<?php

include_once "resources/code/bd_manage.php";

/*
	Enter point of the application.
	Redirects user to 3 cases:
		- CASE A:
			Server does not have permissions to write in this, so database cannot be installed or configured.
			Script redirects to error and tutorial to make it work again.
		- CASE B:
			Database 'G23' does not exist. Script redirects to an installation page in which the user
			can input the options for its server. Then, creates DB and writes config to disk.
			Also, if all goes well, give an option to user for inserting example data to the application
		- CASE C:
			All goes well. User gets redirected to list.php and the competition begins!
*/

			//Checks
			$permissions = false;
			$database = false;

			$permissions = check_permissions();
			$database = check_database();

			if(!$permissions){
			//Redirects user to error and suggestions on how to fix it
				header("Location: ./resources/config/permissions.php");
				die();
			}

			if(!$database){
			//Redirects user to application install
				header("Location: ./resources/config/install.php");
				die();
			}

			//All goes well, redirect user to the application
			header("Location: ./view/list.php");
			

			function check_permissions(){
				if(is_writable("./")){
					return true;
				}else{
					return false;
				}
			}

			function check_database(){
				global $connectHandler;
				return isset($connectHandler);
			}

			
			?>