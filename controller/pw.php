<?php
/* 
Meta-controller and action handler for all app inner requests
All views should include this file if they want a certain project functionality.
All application forms should end in this file
*/

/* LIST OF CONTROLLERS:
	- User : Handles all user related stuff
	- Competition : Handles competition related topics, like editing the information and so on
*/

//Include all controller static classes
	foreach (glob("pwctrl_*.php") as $filename)
	{
		include_once $filename;
	}

//Include all models, to deal with different type of objects.
	include_once "../resources/code/models.php";

//Include language coverage, to ensure all its working with error mensajes and so on
	include_once "../resources/code/lang_coverage.php";

//Check if this script was executed as a standard controller GET request
//Execute appropiate controller action
	if(isset($_GET["controller"]) && isset($_GET["action"])){
		$targetController = ucfirst($_GET["controller"])."Controller";
		$action = $_GET["action"];
		//Call to static class and method linked to a task
		//For the sake of not changing much, $_POST array is treated in the method.
		$targetController::$action();
	}


	?>