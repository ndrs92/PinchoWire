<?php

//fun little code that redirects clients from a relative path correctly.
//Just populate $relpath with your desired path and let the magic go.


$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$relpath = 'view/pinchowire.php'; 

header("Location: http://$host$uri/$relpath");


?>