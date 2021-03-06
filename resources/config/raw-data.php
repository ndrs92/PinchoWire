<?php
include_once("../code/bd_manage.php");

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["installation"])) {
    header("Location: ../../view/403.php");
    exit();
}
$connectHandler->autocommit(false);
try {
    /* Creation of popular juries to sample data */
    $sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado1@wire.es', 'Manuel Domínguez Rodríguez', md5('abc123..'), 'images/sample-data/jurado1@wire.es.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado2@wire.es', 'Rosa Jimenez Fernández', md5('abc123..'), 'images/sample-data/jurado2@wire.es.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado3@wire.es', 'Raul Jimenez Fernández', md5('abc123..'), 'images/sample-data/jurado3@wire.es.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado4@wire.es', 'Lucia Vázquez Lois', md5('abc123..'), 'images/sample-data/jurado4@wire.es.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradopopular (idemail, nombre, contrasena, rutaavatar) VALUES ('jurado5@wire.es', 'Juan Mateo Fernández Camacho', md5('abc123..'), 'images/sample-data/jurado5@wire.es.jpg');";
    mysqli_query($connectHandler, $sql);

    /* Creation of professional juries to sample data */
    $sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Campeon Nacional Pincho Express 2012', 'profesional1@wire.es', 'Jose Francisco Rodríguez Pérez', md5('abc123..'), 'images/avatars/default.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Gerente Restaurante Saturno', 'profesional2@wire.es', 'Paula Fernández López', md5('abc123..'), 'images/avatars/default.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Finalista Campeonato Europeo PinchoWire 2015', 'profesional3@wire.es', 'Raul Martínez Pérez', md5('abc123..'), 'images/avatars/default.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Profesor FP Cocina - Ourense (Desde 2005))', 'profesional4@wire.es', 'Fran Perea López', md5('abc123..'), 'images/avatars/default.jpg');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.juradoprofesional (curriculum, idemail, nombre, contrasena, rutaavatar) VALUES ('Maestro chocolatero, desde 1972', 'profesional5@wire.es', 'Amador Casado Iglesias', md5('abc123..'), 'images/avatars/default.jpg');";
    mysqli_query($connectHandler, $sql);


    /*Creation of establishments to sample data */

    $sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento1@wire.es', 'La Cresta', md5('abc123..'), 'images/sample-data/establecimiento1@wire.es.jpg', 'C/ Rocio 23, Ourense', 'http://establecimiento1.wire.es/', '9:00 - 22:00', 'images/sample-data/establishments/establecimiento1@wire.es.jpg', '42.345350, -7.855956');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento2@wire.es', 'El Gallo', md5('abc123..'), 'images/sample-data/establecimiento2@wire.es.jpg', 'C/ Mercado 57, Ourense', 'http://establecimiento2.wire.es/', '9:00 - 00:00', 'images/sample-data/establishments/establecimiento2@wire.es.jpg', '42.344373, -7.848144');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento3@wire.es', 'A Carballeira', md5('abc123..'), 'images/sample-data/establecimiento3@wire.es.jpg', 'Avda. Santiago 60, Ourense', 'http://establecimiento3.wire.es/', '8:00 - 21:00', 'images/sample-data/establishments/establecimiento3@wire.es.jpg', '42.342343, -7.851845');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento4@wire.es', 'El corredor de Jiménez', md5('abc123..'), 'images/sample-data/establecimiento4@wire.es.jpg', 'Avda. de Marín 4, Ourense', 'http://establecimiento4.wire.es/', '7:30 - 22:00', 'images/sample-data/establishments/establecimiento4@wire.es.jpg', '42.343231, -7.854409');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.establecimiento (idemail, nombre, contrasena, rutaavatar, direccion, web, horario, rutaimagen, geoloc) VALUES ('establecimiento5@wire.es', 'El patio de mi casa', md5('abc123..'), 'images/sample-data/establecimiento5@wire.es.jpg', 'C/ Rui Señor 5, A Coruña', 'http://establecimiento5.wire.es/', '12:00 - 02:00', 'images/sample-data/establishments/establecimiento5@wire.es.jpg', '42.346680, -7.853283');";
    mysqli_query($connectHandler, $sql);

    /*Creation Pincho of to sample data*/
    $sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail, rutaimagen) VALUES ('Banderillas de salmón', 'Banderillas de salmón y otros pescados', '10', 'Salmón, pimiento', NULL, '2', 'establecimiento1@wire.es', 'images/sample-data/pinchos/p1.jpg');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail, rutaimagen) VALUES ('Piñas del mar', 'Tapas de diferentes mariscos', '20', 'Queso, huevo, pan', NULL, '0', 'establecimiento2@wire.es', 'images/sample-data/pinchos/p2.jpg');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail, rutaimagen) VALUES ('Toda mi huerta', 'Jamón, ensaladilla y pollo adornados en pan', '15', 'Jamón, ensaladilla, pimiento, huevo, patatas', NULL, '2', 'establecimiento3@wire.es', 'images/sample-data/pinchos/p3.jpg');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail, rutaimagen) VALUES ('Brocheta de lienzo', 'Brochetas empañadas en una ligera aceituna', '13', 'Brocheta, pimiento y aceituna', NULL, '2', 'establecimiento4@wire.es', 'images/sample-data/pinchos/p4.jpg');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.pincho (idnombre, descripcion, precio, ingredientes, ganadorPopular, estadoPropuesta, establecimiento_idemail, rutaimagen) VALUES ('Sardina express', 'Sardina enlatada en una tosta de pan', '8', 'Sardina, pan', NULL, '2', 'establecimiento5@wire.es', 'images/sample-data/pinchos/p5.jpg' );";
    mysqli_query($connectHandler, $sql);


    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado1@wire.es', 'Banderillas de salmón', 'Un pincho muy bueno, vale la pena', '2015-08-30')";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado3@wire.es', 'Toda mi huerta', 'Aromas agradables y presentación adecuada', '2015-09-16')";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado4@wire.es', 'Brocheta de lienzo', 'Ingredientes malos, no recomendado', '2015-10-16')";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado5@wire.es', 'Sardina express', 'Exquisito', '2015-11-5')";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado1@wire.es', 'Brocheta de lienzo', 'Le falta zanahoria', '2015-11-26')";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado2@wire.es', 'Toda mi huerta', 'El perfecto entrante', '2015-11-19')";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado3@wire.es', 'Banderillas de salmón', 'Debería servirse en menor cantidad', '2015-11-15')";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.comentario (juradopopular_idemail, pincho_idnombre, contenido, fecha) VALUES ('jurado4@wire.es', 'Sardina express', 'La combinación no es muy adecuada', '2015-11-12')";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional1@wire.es', 'Banderillas de salmón');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional3@wire.es', 'Toda mi huerta');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional4@wire.es', 'Brocheta de lienzo');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.asignado (juradoprofesional_idemail, pincho_idnombre) VALUES ('profesional5@wire.es', 'Sardina express');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Banderillas de salmón', '56536a115871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Banderillas de salmón', '56536a215871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Banderillas de salmón', '56536a315871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Banderillas de salmón', '56536a415871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Banderillas de salmón', '56536a515871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Toda mi huerta', '56536b115871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Toda mi huerta', '56536b215871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Toda mi huerta', '56536b315871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Toda mi huerta', '56536b415871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Toda mi huerta', '56536b515871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Brocheta de lienzo', '56536b615871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Brocheta de lienzo', '56536b715871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Brocheta de lienzo', '56536b815871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Brocheta de lienzo', '56536b915871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Brocheta de lienzo', '56536b015871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Sardina express', '56536b115871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Sardina express', '56536b215871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Sardina express', '56536b315871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Sardina express', '56536b415871f');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.codigo (pincho_idnombre, idcodigo) VALUES ('Sardina express', '56536b515871f');";
    mysqli_query($connectHandler, $sql);

    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Banderillas de salmón', 'jurado1@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Toda mi huerta', 'jurado3@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Brocheta de lienzo', 'jurado4@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Sardina express', 'jurado5@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Banderillas de salmón', 'jurado5@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Toda mi huerta', 'jurado4@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Brocheta de lienzo', 'jurado2@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Sardina express', 'jurado1@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Banderillas de salmón', 'jurado2@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Toda mi huerta', 'jurado5@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Brocheta de lienzo', 'jurado1@wire.es');";
    mysqli_query($connectHandler, $sql);
    $sql = "INSERT INTO G23.probado (pincho_idnombre, juradopopular_idemail) VALUES ('Sardina express', 'jurado2@wire.es');";
    mysqli_query($connectHandler, $sql);
} catch (Exception $e) {
    $connectHandler->rollback();
}
    $connectHandler->autocommit(true);

header("Location: ../../index.php");

?>