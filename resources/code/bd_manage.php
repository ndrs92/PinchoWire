<?php

$connectHandler = mysqli_connect("127.0.0.1", "g23_abp_user", "abc123.", "G23");

if (mysqli_connect_errno())
{
	unset($connectHandler);
}

?>