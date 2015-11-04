<?php

foreach (glob("../resources/code/*.php") as $filename)
{
	include_once $filename;

}

?>