<?php

/*
	Sets cookie for language support.
	Redirects user to previous page using javascript.
*/

if(isset($_GET["l"])){
	setcookie("user_lang", $_GET["l"], time()+3600*24, "/");
}
echo '<script type="text/javascript">history.go(-1);</script>';

?>
