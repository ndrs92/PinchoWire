<?php
include_once("../code/bd_manage.php");

/* Creation of popular juries to sample data */
$sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado1@wire.es', 'Jurado 1', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado2@wire.es', 'Jurado 2', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado3@wire.es', 'Jurado 3', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado4@wire.es', 'Jurado 4', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado5@wire.es', 'Jurado 5', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

/* Creation of professional juries to sample data */
$sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Currículum del Jurado Profesional 1', 'profesional1@wire.es', 'Profesional 1', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Currículum del Jurado Profesional 2', 'profesional2@wire.es', 'Profesional 2', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Currículum del Jurado Profesional 3', 'profesional3@wire.es', 'Profesional 3', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Currículum del Jurado Profesional 4', 'profesional4@wire.es', 'Profesional 4', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Currículum del Jurado Profesional 5', 'profesional5@wire.es', 'Profesional 5', 'abc123..', 'images/avatars/default.jpg');";
mysqli_query($connectHandler, $sql);


/*Creation of establishments to sample data */

$sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento1@wire.es', 'Establecimiento 1', 'abc123..', 'images/avatars/default.jpg', 'C/ Establecimiento 1', 'http://establecimiento1.wire.es/', '9:00 - 21:00', 'images/establishments/default.jpg', '42.345350, -7.855956');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento2@wire.es', 'Establecimiento 2', 'abc123..', 'images/avatars/default.jpg', 'C/ Establecimiento 2', 'http://establecimiento2.wire.es/', '9:00 - 21:00', 'images/establishments/default.jpg', '42.344373, -7.848144');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento3@wire.es', 'Establecimiento 3', 'abc123..', 'images/avatars/default.jpg', 'C/ Establecimiento 3', 'http://establecimiento3.wire.es/', '9:00 - 21:00', 'images/establishments/default.jpg', '42.342343, -7.851845');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento4@wire.es', 'Establecimiento 4', 'abc123..', 'images/avatars/default.jpg', 'C/ Establecimiento 4', 'http://establecimiento4.wire.es/', '9:00 - 21:00', 'images/establishments/default.jpg', '42.343231, -7.854409');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento5@wire.es', 'Establecimiento 5', 'abc123..', 'images/avatars/default.jpg', 'C/ Establecimiento 5', 'http://establecimiento5.wire.es/', '9:00 - 21:00', 'images/establishments/default.jpg', '42.346680, -7.853283');";
mysqli_query($connectHandler, $sql);

/*Creation Pincho of to sample data*/
$sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail) VALUES ('Pincho 1', 'Descripcion del Pincho 1', '1', 'Ingrediente 1, Ingrediente 2', NULL, '2', 'establecimiento1@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail) VALUES ('Pincho 2', 'Descripcion del Pincho 2', '2', 'Ingrediente 2, Ingrediente 3', NULL, '0', 'establecimiento2@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail) VALUES ('Pincho 3', 'Descripcion del Pincho 3', '3', 'Ingrediente 3, Ingrediente 4', NULL, '2', 'establecimiento3@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail) VALUES ('Pincho 4', 'Descripcion del Pincho 4', '4', 'Ingrediente 4, Ingrediente 5', NULL, '2', 'establecimiento4@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail) VALUES ('Pincho 5', 'Descripcion del Pincho 5', '5', 'Ingrediente 5, Ingrediente 1', NULL, '2', 'establecimiento5@wire.es');";
mysqli_query($connectHandler, $sql);


$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado1@wire.es', 'Pincho 1', 'Un pincho muy bueno, vale la pena', '2015-08-30')";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado3@wire.es', 'Pincho 3', 'Aromas agradables y presentación adecuada', '2015-09-16')";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado4@wire.es', 'Pincho 4', 'Ingredientes malos, no recomendado', '2015-10-16')";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado5@wire.es', 'Pincho 5', 'Exquisito', '2015-11-5')";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado1@wire.es', 'Pincho 4', 'Le falta zanahoria', '2015-11-26')";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado2@wire.es', 'Pincho 3', 'El perfecto entrante', '2015-11-19')";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado3@wire.es', 'Pincho 1', 'Debería servirse en menor cantidad', '2015-11-15')";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado4@wire.es', 'Pincho 5', 'La combinación no es muy adecuada', '2015-11-12')";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional1@wire.es', 'Pincho 1');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional3@wire.es', 'Pincho 3');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional4@wire.es', 'Pincho 4');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional5@wire.es', 'Pincho 5');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 1', '56536a115871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 1', '56536a215871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 1', '56536a315871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 1', '56536a415871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 1', '56536a515871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 3', '56536b115871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 3', '56536b215871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 3', '56536b315871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 3', '56536b415871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 3', '56536b515871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 4', '56536b615871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 4', '56536b715871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 4', '56536b815871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 4', '56536b915871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 4', '56536b015871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 5', '56536b115871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 5', '56536b215871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 5', '56536b315871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 5', '56536b415871f');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Pincho 5', '56536b515871f');";
mysqli_query($connectHandler, $sql);

$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 1', 'jurado1@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 3', 'jurado3@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 4', 'jurado4@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 5', 'jurado5@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 1', 'jurado5@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 3', 'jurado4@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 4', 'jurado2@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 5', 'jurado1@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 1', 'jurado2@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 3', 'jurado5@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 4', 'jurado1@wire.es');";
mysqli_query($connectHandler, $sql);
$sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Pincho 5', 'jurado2@wire.es');";
mysqli_query($connectHandler, $sql);


header("Location: ../../index.php");

?>



1
2
3
4
5