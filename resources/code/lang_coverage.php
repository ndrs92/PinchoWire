<?php
//Sets Session language if exists, if not, sets spanish as default

if(isset($_SESSION["user_lang"])){
	include_once "../i18n/".$_SESSION["user_lang"]."php";
}else{
	include_once "../i18n/es.php";
}


?>